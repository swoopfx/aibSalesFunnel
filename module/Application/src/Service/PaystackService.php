<?php  

namespace Application\Service;

use Exception;
use Laminas\Http\Client;

class PaystackService {

    private $entityManager;


    private $paystackDetails;

    const PAYSTACK_VERFY_URL = "https://api.paystack.co/transaction/verify";
    

    public function verifyTransaction($ref, $invoiceUid){
        $header = [];
        $secretKey = $this->paystackDetails["paystackSecret"];
        // $header["Content-Type"]= "";
        $header["Authorization"] = "Bearer {$secretKey}";
        $client = new Client();
        $client->setMethod("GET");
        $client->setUri(self::PAYSTACK_VERFY_URL."/{$ref}");
        $client->setHeaders($header);
        $response = $client->send();
        if($response->isSuccess()){
            $body = json_decode($response->getBody());
            return $body;

            

        }else{
            throw new \Exception("Verification error");
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
}