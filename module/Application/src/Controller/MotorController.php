<?php

namespace Application\Controller;

use Application\Entity\MotorInsurance;
use Application\Entity\User;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Service\FunnelSession;

class MotorController extends AbstractActionController
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
     * @var FunnelSession
     */
    private $funnelSession;

    private $generalService;

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }


    public function initiateMotorAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    public function viewAllAction()
    {
        $viewModel = new ViewModel();
        $userEntity = $this->entityManager->getRepository(User::class)->findOneBy([
            "uuid" => $this->funnelSession->getSessionUid()
        ]);
        $data = $this->entityManager->getRepository(MotorInsurance::class)->findBy([
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
