<?php

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use Application\Service\TransactionService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container;
use Laminas\View\Model\JsonModel;
use Application\Service\PaystackService;

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

    /**
     * Undocumented variable
     *
     * @var PaystackService
     */
    private $paystackService;

    public function verifypaymentAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        $data = $request->getPost()->toArray();
        // var_dump($data["response"]);
        
        
        try {
            $this->paystackService->verifyTransaction($data);
            $response->setStatusCode(201);

        } catch (\Throwable $th) {
            $jsonModel->setVariables([
                "messages"=>$th->getMessage(),
                "trace"=>$th->getTrace()
            ]);
            $response->setStatusCode(400);
        }
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

    /**
     * Get undocumented variable
     *
     * @return  PaystackService
     */ 
    public function getPaystackService()
    {
        return $this->paystackService;
    }

    /**
     * Set undocumented variable
     *
     * @param  PaystackService  $paystackService  Undocumented variable
     *
     * @return  self
     */ 
    public function setPaystackService(PaystackService $paystackService)
    {
        $this->paystackService = $paystackService;

        return $this;
    }
}
