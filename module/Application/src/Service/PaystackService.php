<?php

namespace Application\Service;

use Exception;
use Laminas\Http\Client;
use Application\Service\TransactionService;

class PaystackService
{

    private $entityManager;


    private $paystackDetails;

    /**
     * Undocumented variable
     *
     * @var TransactionService
     */
    private $transactionService;

    const PAYSTACK_VERFY_URL = "https://api.paystack.co/transaction/verify";


    public function verifyTransaction($data)
    {
        $header = [];
        $secretKey = $this->paystackDetails["paystackSecret"];
        // $header["Content-Type"]= "";
        $header["Authorization"] = "Bearer {$secretKey}";
        $client = new Client();
        $client->setMethod("GET");
        $client->setUri(self::PAYSTACK_VERFY_URL . "/{$data['ref']}");
        $client->setHeaders($header);
        $response = $client->send();
        if ($response->isSuccess()) {
            $body = json_decode($response->getBody());
            $transacionData["invoice"] = $data["invoice"];
            $transacionData["pRef"] = $data["ref"];
            $transacionData["pTrans"] = $data["transaction"];
            $this->transactionService->finalizeSuccessfulTransaction($transacionData);
            return $body;
        } else {
            throw new \Exception("Payment Verification error");
        }
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
     * Get the value of paystackDetails
     */
    public function getPaystackDetails()
    {
        return $this->paystackDetails;
    }

    /**
     * Set the value of paystackDetails
     *
     * @return  self
     */
    public function setPaystackDetails($paystackDetails)
    {
        $this->paystackDetails = $paystackDetails;

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
