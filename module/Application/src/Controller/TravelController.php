<?php
namespace Application\Controller;

use Application\Service\GeneralService;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;

class TravelController extends AbstractActionController{

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Undocumented variable
     *
     * @var GeneralService
     */
    private $generalService;

    public function travelAction(){
        $jsonModel = new JsonModel();
        return $jsonModel;
    }

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
}