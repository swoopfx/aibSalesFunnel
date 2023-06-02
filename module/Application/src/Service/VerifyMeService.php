<?php

namespace Application\Service;

use Application\Service\GeneralService;
use Doctrine\ORM\EntityManager;
use Application\Entity\Settings;
use Application\Entity\vNinData;
use Laminas\Http\Client;
use Laminas\Json\Json;

class VerifyMeService
{

    const IDENTITY_TYPE_VNIN = 100;

    const IDENTITY_TYPE_PASSPORT = 300;

    const IDENTITY_TYPE_DRIVER_LICENSE = 200;

    const IDENTITY_TYPE_CAC = 1000;

    const IDENTITY_TYPE_VOTERS_CARD = 400;
    /**
     * Undocumented variable
     *
     * @var GeneralService
     */
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
     * @var Settings
     */
    private $settings;

    private $qoreIdPayload;

    private $firstname;

    private $lastname;

    public function __construct()
    {
        $this->firstname = "John";
        $this->lastname = "Doe";
    }

    private function vNIN($nin)
    {

        $client = new Client();
        $client->setUri("https://api.qoreid.com/v1/ng/identities/virtual-nin/{$nin}");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            "Accept" => 'application/json',
            'Authorization' => 'Bearer ' . $this->qoreIdPayload->accessToken
        ));
        $data = [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,

        ];
        // $client->setHeaders($header);
        $client->setRawBody(json_encode($data));

        $res = $client->send();
        if ($res->isSuccess()) {
            $rData = json_decode($res->getBody());
            return $rData;
        } else {
            throw new \Exception($res->getReasonPhrase());
        }
    }

    private function driverLicense($dl)
    {
        $client = new Client();
        $client->setUri("https://api.qoreid.com/v1/ng/identities/drivers-license/{$dl}");
        $client->setMethod("POST");
        // $client->setAuth();

        // var_dump($this->qoreIdPayload->accessToken);
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            "Accept" => 'application/json',
            'Authorization' => 'Bearer ' . $this->qoreIdPayload->accessToken
        ));

        // $headers["authorization"] = 'Bearer ' . $this->qoreIdPayload->accessToken;
        $data = [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
        ];

        $client->setRawBody(json_encode($data));

        $res = $client->send();
        if ($res->isSuccess()) {
            $rData = json_decode($res->getBody());
            return $rData;
        } else {
            // var_dump($res->getStatusCode());
            throw new \Exception($res->getReasonPhrase());
        }
    }

    private function passport($passport)
    {

        $client = new Client();
        $client->setUri("https://api.qoreid.com/v1/ng/identities/passport/{$passport}");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            "Accept" => 'application/json',
            'Authorization' => 'Bearer ' . $this->qoreIdPayload->accessToken
        ));
        $data = [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
        ];

        $client->setRawBody(json_encode($data));

        $res = $client->send();
        if ($res->isSuccess()) {
            $rData = json_decode($res->getBody());
            return $rData;
        } else {
            throw new \Exception("something went wront");
        }
    }

    private function cac($reg)
    {
        $client = new Client();
        $client->setUri("https://api.qoreid.com/v1/ng/identities/cac-basic");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            "Accept" => 'application/json',
            'Authorization' => 'Bearer ' . $this->qoreIdPayload->accessToken
        ));
        $data = [
            "regNumber" => $reg,

        ];
        $client->setRawBody(json_encode($data));

        $res = $client->send();
        if ($res->isSuccess()) {
            $rData = json_decode($res->getBody());
            return $rData;
        } else {
            throw new \Exception("something went wront");
        }
    }

    private function votersCard($vin)
    {

        $client = new Client();
        $client->setUri("https://api.qoreid.com/v1/ng/identities/vin/{$vin}");
        $client->setMethod("POST");
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            "Accept" => 'application/json',
            'Authorization' => 'Bearer ' . $this->qoreIdPayload->accessToken
        ));
        $data = [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,

        ];
        // $client->setHeaders($header);
        $client->setRawBody(json_encode($data));

        $res = $client->send();
        if ($res->isSuccess()) {
            $rData = json_decode($res->getBody());
            return $rData;
        } else {
            throw new \Exception("something went wront");
        }
    }




    public function identityVerify($data)
    {
        $em = $this->entityManager;
        $responseData = "";
        switch ($data["type"]) {
            case self::IDENTITY_TYPE_VNIN:
                $responseData = $this->vNIN($data["value"]);
                $v_nin = $responseData->v_nin;
                return [
                    "firtname" => $v_nin->firstname,
                    "lastname" => $v_nin->lastname,
                    "dob" => $v_nin->birthdate,
                    "data" => Json::encode($responseData),
                ];
                break;
            case self::IDENTITY_TYPE_DRIVER_LICENSE:
                $responseData = $this->driverLicense($data["value"]);
                $dl = $responseData->drivers_license;
                return [
                    "firtname" => $dl->firstname,
                    "lastname" => $dl->lastname,
                    "dob" => $dl->birthdate,
                    "data" => Json::encode($responseData),
                ];
                break;

            case self::IDENTITY_TYPE_PASSPORT:
                $responseData = $this->passport($data["value"]);
                $vc = $responseData->passport;
                return [
                    "firtname" => $vc->firstname,
                    "lastname" => $vc->lastname,
                    "dob" => $vc->birthdate,
                    "data" => Json::encode($responseData),
                ];
                break;

            case self::IDENTITY_TYPE_VOTERS_CARD:
                $responseData = $this->votersCard($data["value"]);
                $vc = $responseData->voters_card;
                return [
                    "firtname" => $vc->firstName,
                    "lastname" => $vc->lastName,
                    "dob" => $vc->birthdate,
                    "data" => Json::encode($responseData),
                ];
                break;

            case self::IDENTITY_TYPE_CAC:
                $responseData = $this->cac($data["value"]);
                $vc = $responseData->cac;
                return [
                    "company_name" => $vc->companyName,
                    "company_type" => $vc->companyType,
                    "status" => $vc->status,
                    "data" => Json::encode($responseData),
                ];
                break;
        }

        return $responseData;
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
     * @return  Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set undocumented variable
     *
     * @param  Settings  $settings  Undocumented variable
     *
     * @return  self
     */
    public function setSettings(Settings $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get the value of qoreIdPayload
     */
    public function getQoreIdPayload()
    {
        return $this->qoreIdPayload;
    }

    /**
     * Set the value of qoreIdPayload
     *
     * @return  self
     */
    public function setQoreIdPayload($qoreIdPayload)
    {
        $this->qoreIdPayload = $qoreIdPayload;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }
}
