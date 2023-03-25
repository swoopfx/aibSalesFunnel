<?php

namespace Application\Service;

use Exception;
use Laminas\Http\Client;
use Application\Service\TransactionService;
use Application\Service\GeneralService;
use Application\Entity\Settings;
use Throwable;

class PaystackService
{

    private $entityManager;

    /**
     * Undocumented variable
     *
     * @var GeneralService
     */
    private $generalService;


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
        /**
         * @var Settings
         */
        $settings = $this->generalService->getSettings();
        $secretKey = $settings->getPaystackSecret();
        // var_dump($secretKey);
        $header["Authorization"] = "Bearer {$secretKey}";
        //  var_dump($header);
        $client = new Client();
        $client->setMethod("GET");
        $client->setUri(self::PAYSTACK_VERFY_URL . "/{$data['ref']}");
        $client->setHeaders($header);
        $response = $client->send();
        // var_dump($response);

        if ($response->isSuccess()) {
            try {
                $body = json_decode($response->getBody());
                // var_dump($body);
                $transacionData["invoice"] = $data["ref"];
                $transacionData["pRef"] = $data["ref"];
                $transacionData["pTrans"] = $data["transaction"];
                $transacionData["company_name"] = $settings->getCompanyName();
                $transacionData["company_address"] = $settings->getCompanyAddress();
                $transacionData["company_email"] = $settings->getCompanyEmail();
                $transacionData["company_logo"] = $settings->getCompanyLogo();
                $transacionData["base_url"] = $settings->getBaseUrl();

                $this->transactionService->finalizeSuccessfulTransaction($transacionData);
            } catch (\Throwable $th) {
                throw new \Exception($th->getMessage());
            }


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
