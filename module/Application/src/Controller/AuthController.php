<?php

namespace Application\Controller;

use Application\Entity\Roles;
use Application\Entity\User;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Application\Form\RegisterInputFilter;
use Application\Form\LoginInputFilter;
use Application\Service\UserService;
// use Laminas\Db\Sql\Ddl\Column\Datetime;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\EntityManager;
use Application\Service\FunnelSession;

class AuthController extends AbstractActionController
{


    /**
     * Undocumented variable
     *
     * @var RegisterInputFilter
     */
    private $registerInputFilter;

    /**
     * 
     *
     * @var LoginInputFilter
     */
    private $loginInputFilter;

    /**
     * Undocumented variable
     *
     * @var FunnelSession
     */
    private $funnelSession;


    private $generalService;

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    public function indexAction()
    {
    }


    public function loginAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        $em = $this->entityManager;
        $loginInputFilter = $this->loginInputFilter;
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $loginInputFilter->setValidationGroup([
                "phoneOrEmail"
            ]);
            $loginInputFilter->setData($post);
            if ($loginInputFilter->isValid()) {
                try {
                    $phoneOrEmail = '';
                    /**
                     * @var User
                     */
                    $user = $em->createQuery("SELECT u FROM Application\Entity\User u WHERE u.email = '$phoneOrEmail' OR u.phonenumber = '$phoneOrEmail'")->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
                    if (count($user) != 0) {
                        // Start Funnel Session
                        // return a reload
                        $sessionData["uuid"] = $user[0]->getUuid();
                        $sessionData["name"] = $user[0]->getFullname();
                        $this->funnelSession->createSession($sessionData);

                        $response->setStatusCode(200);
                        $jsonModel->setVariables([
                            "success" => true,
                            "user" => [
                                "name" => $user[0]->getFullname(),
                                "uuid" => $user[0]->getUuid()
                            ]
                        ]);
                    } else {
                        $response->setStatusCode(200);
                        $jsonModel->setVariables([
                            "success" => false,
                            "message" => "You need to be registered  first "
                        ]);
                    }
                } catch (\Throwable $th) {
                    $response->setStatusCode(400);
                    $jsonModel->setVariables([
                        "success" => false,
                        "message" => $loginInputFilter->getMessages()
                    ]);
                }
            }
        }

        return $jsonModel;
    }

    public function registerAction()
    {
        $jsonModel = new JsonModel();
        $em = $this->entityManager;
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $registerInputFilter = $this->registerInputFilter;
            $registerInputFilter->setValidationGroup([
                "email",
                "emailVerify",
                "phonenumber",
                "fullname"
            ]);
            $registerInputFilter->setData($post);
            if ($registerInputFilter->isValid()) {
                $data = $registerInputFilter->getValues();
                try {
                    $activationToken = uniqid(mt_rand(), true);
                    $userEntity = new User();
                    $userEntity->setCreatedOn(new \Datetime())
                        ->setEmail($data["email"])
                        ->setFullname($data["fullname"])
                        ->setRole($em->find(Roles::class, UserService::USER_ROLE_CUSTOMER))
                        ->setRegistrationToken($activationToken)
                        ->setEmailConfirmed(FALSE)
                        ->setUuid(Uuid::uuid4())
                        ->setIsActive(TRUE)
                        ->setPhonenumber($data['phonenumber']);


                    $em->persist($userEntity);
                    $em->flush();

                    // register user email and phone on sendInblue for email marketing

                    $response->setStatusCode(201);
                    $jsonModel->setVariables([
                        "success" => true,
                        "reload" => true,
                    ]);
                } catch (\Throwable $th) {
                    $jsonModel->setVariables([
                        "success" => false,
                        "description" => $th->getMessage(),
                        // "errors" => $
                    ]);
                    $response->setStatusCode(400);
                }
            } else {
                $jsonModel->setVariables([
                    "success" => false,
                    "description" => $registerInputFilter->getMessages(),
                    // "errors" => $
                ]);
                $response->setStatusCode(400);
            }
        }

        return $jsonModel;
    }

    public function logoutAction(){
        
        $this->funnelSession->closeSession();
        $response = $this->getResponse();
        $response->setStatusCode(204);
        return new JsonModel();
    }

    /**
     * Get the value of registerInputFilter
     */
    public function getRegisterInputFilter()
    {
        return $this->registerInputFilter;
    }

    /**
     * Set the value of registerInputFilter
     *
     * @return  self
     */
    public function setRegisterInputFilter($registerInputFilter)
    {
        $this->registerInputFilter = $registerInputFilter;

        return $this;
    }

    /**
     * Get the value of generalService
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     * Set the value of generalService
     *
     * @return  self
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;

        return $this;
    }

    /**
     * Get the value of entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set the value of entityManager
     *
     * @return  self
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * Get the value of loginInputFilter
     *
     * @return  LoginInputFilter
     */
    public function getLoginInputFilter()
    {
        return $this->loginInputFilter;
    }

    /**
     * Set the value of loginInputFilter
     *
     * @param  LoginInputFilter  $loginInputFilter
     *
     * @return  self
     */
    public function setLoginInputFilter(LoginInputFilter $loginInputFilter)
    {
        $this->loginInputFilter = $loginInputFilter;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  FunnelSession
     */ 
    public function getFunnelSession()
    {
        return $this->funnelSession;
    }

    /**
     * Set undocumented variable
     *
     * @param  FunnelSession  $funnelSession  Undocumented variable
     *
     * @return  self
     */ 
    public function setFunnelSession(FunnelSession $funnelSession)
    {
        $this->funnelSession = $funnelSession;

        return $this;
    }
}
