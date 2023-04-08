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
use Doctrine\ORM\Query;
use Laminas\Http\Header\SetCookie;
use Laminas\InputFilter\InputFilter;
use Laminas\View\Model\ViewModel;
use Application\Service\SendInBlueMarketing;

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

    /**
     * Undocumented variable
     *
     * @var SendInBlueMarketing
     */
    private $sendInBlue;

    public function sessionAction()
    {
        $jsonModel = new JsonModel();
        // $this->
        $request = $this->getRequest();
        $cookie = $request->getHeaders()->get("Cookie");
        $sessionUid = null;
        // if (isset($cookie->igibber)) {
        //     $sessionUid = $cookie->igibber;
        // } else {
            $sessionUid = $this->funnelSession->getSessionUid();
        // }
        $data = $this->entityManager->getRepository(User::class)->findOneBy([
            "uuid" => $sessionUid,
        ]);
        if ($data != null) {
            $resData = [
                "fullname" => $data->getFullname(),
                "uid" => $this->funnelSession->getSessionUid(),
                "phone" => $data->getPhonenumber(),
                "email" => $data->getEmail(),
            ];
            $jsonModel->setVariables([
                "data" => $resData
            ]);
        } else {
            $jsonModel->setVariables([
                "data" => null
            ]);
        }

        return $jsonModel;
    }

    public function emailstatusAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $em = $this->entityManager;
        $jsonModel = new JsonModel();
        if ($request->isPost()) {
            $post = $request->getPost();
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'email',
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Your email is required'
                            )
                        )
                    )
                )
            ));
            $inputFilter->setData($post);
            if ($inputFilter->isValid()) {
                $data = $inputFilter->getValues();
                try {
                    $email = $data['email'];
                    $dql = "SELECT u FROM Application\Entity\User u  WHERE u.email= '$email' ";
                    $res = $em->createQuery($dql)->getResult(Query::HYDRATE_OBJECT);

                    if (count($res) > 0) {
                        $cookie =  $this->createSession($res[0]);
                       
                       
                        $response->getHeaders()->addHeader($cookie);
                        $jsonModel->setVariables([
                            "isRegister" => false,
                            "user" => [
                                "name" => $res[0]->getFullname(),
                                "uuid" => $res[0]->getUuid()
                            ]
                        ]);
                        $response->setStatusCode(200);
                    } else {
                        $jsonModel->setVariables([
                            "isRegister" => true,
                        ]);
                        $response->setStatusCode(200);
                    }
                    // Search for email in Database,
                    // If Email Exist start session and get User Details
                    // Else Show form wizard of phone number , full name and email 
                } catch (\Throwable $th) {
                    $jsonModel->setVariables([
                        "messages" => $th->getMessage(),
                        "data" => "Error"
                    ]);

                    $response->setStatusCode(400);
                }
            }
        }
        return $jsonModel;
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
                        $cookie =  $this->createSession($user[0]);
                        $response->getHeaders()->addHeader($cookie);

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

    private function createSession($user)
    {
        $sessionData["uuid"] = $user->getUuid();
        $sessionData["name"] = $user->getFullname();
        $this->funnelSession->createSession($sessionData);
        return new SetCookie("igibber", $sessionData["uuid"],  time() + 50 * 60 * 60 * 24);
    }

    public function registerAction()
    {
        $jsonModel = new JsonModel();
        $em = $this->entityManager;
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            // var_dump($post);
            $registerInputFilter = $this->registerInputFilter;
            $registerInputFilter->setValidationGroup([
                "email",
                "emailVerify",
                "phonenumber",
                "fullname",
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
                   

                    $cookie = $this->createSession($userEntity);
                    $response->getHeaders()->addHeader($cookie);

                    // $number = intval($userEntity->getPhonenumber());
                    $sendInBlue["email"] = $userEntity->getEmail();
                    $sendInBlue["fullname"] = $userEntity->getFullname();
                    // $sendInBlue["sms"] = "234".$number;

                    //$this->sendInBlue->createContact($sendInBlue);

                    $em->flush();

                    // register user email and phone on sendInblue for email marketing or any campaign tool

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

    public function logoutAction()
    {
        $response = $this->getResponse();
        $cookie = $this->getRequest()->getCookie();
        if ($cookie->offsetExists('igibber')) {
            $new_cookie = new SetCookie('igibber', ''); //<---empty value and the same 'name'
            
            $response->getHeaders()->addHeader($new_cookie);
        }
        $this->funnelSession->closeSession();

        $response->setStatusCode(204);
        $this->redirect()->toRoute("home");
        return new ViewModel();
    }

    // public function 

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

    /**
     * Get undocumented variable
     *
     * @return  SendInBlueMarketing
     */ 
    public function getSendInBlue()
    {
        return $this->sendInBlue;
    }

    /**
     * Set undocumented variable
     *
     * @param  SendInBlueMarketing  $sendInBlue  Undocumented variable
     *
     * @return  self
     */ 
    public function setSendInBlue(SendInBlueMarketing $sendInBlue)
    {
        $this->sendInBlue = $sendInBlue;

        return $this;
    }
}
