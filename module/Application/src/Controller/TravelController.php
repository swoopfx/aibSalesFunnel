<?php

namespace Application\Controller;

use Application\Entity\TravelInsuranceVariant;
use Application\Form\TravelInputFIlter;
use Application\Service\GeneralService;
use Application\Service\TravelService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;

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
                    $travelService = $this->travelService;
                    $travelService->initiateTravelinsurance($data);
                    $jsonModel->setVariables([
                        "status" => "success",
                        "data" => $data, // this include user entity, invoice data and other  specific details

                    ]);
                    $response->setStatusCode(201);
                } catch (\Throwable $th) {
                    $jsonModel->setVariables([
                        "messages" => $th->getMessage()
                    ]);
                    $response->setStatusCode(400);
                }
            } else {
            }
        }
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
}
