<?php

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use Application\Service\TransactionService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container;
use Laminas\View\Model\JsonModel;

class InvoiceController extends AbstractActionController
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
     * @var TransactionService
     */
    private $transactionService;

    // private 

    public function verifypaymentAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $data = $request->getPost()->toArray();
        // var_dump($data["response"]);
        return $jsonModel;
    }


    public function invoiceSessionAction()
    {
        $jsonModel = new JsonModel();
        $container = new Container("invoicesession");
        $jsonModel->setVariables([
            "data" => [
                "email" => $container->email,
                "pkey" => $container->pkey,
                "amount" => $container->amount,
                "ref" => $container->invoiceref,
            ]
        ]);
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
     * @return  TransactionService
     */
    public function getTransactionService()
    {
        return $this->transactionService;
    }

    /**
     * Set undocumented variable
     *
     * @param  TransactionService  $transactionService  Undocumented variable
     *
     * @return  self
     */
    public function setTransactionService(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;

        return $this;
    }
}
