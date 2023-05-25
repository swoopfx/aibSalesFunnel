<?php

namespace Application\Controller;

use Application\Entity\TravelInsurance;
use Application\Entity\TravelInsuranceVariant;
use Application\Entity\User;
use Application\Form\TravelInputFIlter;
use Application\Service\GeneralService;
use Application\Service\TravelService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Application\Service\FunnelSession;


class TravelController extends AbstractActionController
{

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Undocumented variable
     *
     * @var TravelInputFIlter
     */
    private $travelInputFilter;

    /**
     * Undocumented variable
     *
     * @var GeneralService
     */
    private $generalService;

    /**
     * @var FunnelSession
     */
    private $funnelSession;


    /**
     * 
     *
     * @var TravelService
     */
    private $travelService;

    public function intiateAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post = $request->getPost();
            // var_dump($post);
            $inputFilter  = $this->travelInputFilter;
            $inputFilter->setData($post);
            if ($inputFilter->isValid()) {
                try {
                    $data = $inputFilter->getValues();
                    // var_dump($post["travelList"]);
                    $data["travelList"] = json_decode($post["travelList"]);
                    $travelService = $this->travelService;
                    // var_dump($data);
                    $responseData = $travelService->initiateTravelinsurance($data);
                    $jsonModel->setVariables([
                        "status" => "success",
                        "data" => $responseData, // this include user entity, invoice data and other  specific details

                    ]);
                    $response->setStatusCode(201);
                } catch (\Throwable $th) {
                    $jsonModel->setVariables([
                        "messages" => $th->getMessage()
                    ]);
                    $response->setStatusCode(400);
                }
            } else {
                $jsonModel->setVariables([
                    "messages" => $inputFilter->getMessages()
                ]);
                $response->setStatusCode(400);
            }
        }
        return $jsonModel;
    }


    public function viewAllAction()
    {
        $viewModel = new ViewModel();
        $userEntity = $this->entityManager->getRepository(User::class)->findOneBy([
            "uuid" => $this->funnelSession->getSessionUid()
        ]);
        $data = $this->entityManager->getRepository(TravelInsurance::class)->findBy([
            "user" => $userEntity->getId(),
            "isActive" => TRUE
        ], [
            "id" => "DESC",
        ], 100);
        $viewModel->setVariables([
            "data" => $data
        ]);
        return $viewModel;
    }



    public function editAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    public function getVariantAction()
    {
        $jsonModel = new JsonModel();
        $em = $this->entityManager;
        $repo = $em->getRepository(TravelInsuranceVariant::class);
        $data = $repo->createQueryBuilder("l")
            ->select("l")
            ->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY)
            ->getArrayResult();
        $jsonModel->setVariables([
            "data" => $data
        ]);
        return $jsonModel;
    }


    public function getVariantDescriptionAction()
    {
        $jsonModel = new JsonModel();
        $id = $this->params()->fromRoute("id");
        $data = $this->entityManager->find(TravelInsuranceVariant::class, $id);
        $jsonModel->setVariables([
            "data" => $data->getDescription(),
            "head" => $data->getVariant(),
        ]);
        return $jsonModel;
    }

    // public fun

    /**
     * Get undocumented variable
     *
     * @return  EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set undocumented variable
     *
     * @param  EntityManager  $entityManager  Undocumented variable
     *
     * @return  self
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  GeneralService
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     * Set undocumented variable
     *
     * @param  GeneralService  $generalService  Undocumented variable
     *
     * @return  self
     */
    public function setGeneralService(GeneralService $generalService)
    {
        $this->generalService = $generalService;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  TravelIn
     */
    public function getTravelInputFilter()
    {
        return $this->travelInputFilter;
    }

    /**
     * Set undocumented variable
     *
     * @param $travelInputFilter  Undocumented variable
     *
     * @return  self
     */
    public function setTravelInputFilter($travelInputFilter)
    {
        $this->travelInputFilter = $travelInputFilter;

        return $this;
    }

    /**
     * Get the value of travelService
     *
     * @return  TravelService
     */
    public function getTravelService()
    {
        return $this->travelService;
    }

    /**
     * Set the value of travelService
     *
     * @param  TravelService  $travelService
     *
     * @return  self
     */
    public function setTravelService(TravelService $travelService)
    {
        $this->travelService = $travelService;

        return $this;
    }

    /**
     * Get the value of funnelSession
     *
     * @return  FunnelSession
     */
    public function getFunnelSession()
    {
        return $this->funnelSession;
    }

    /**
     * Set the value of funnelSession
     *
     * @param  FunnelSession  $funnelSession
     *
     * @return  self
     */
    public function setFunnelSession($funnelSession)
    {
        $this->funnelSession = $funnelSession;

        return $this;
    }
}
