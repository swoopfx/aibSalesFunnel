<?php

namespace Application\Service;

use Application\Entity\MotorInsurance;
use Application\Entity\MotorinsuranceCoverType;
use Application\Entity\Uploads;
use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Application\Service\UploadService;
use Exception;
use Application\Service\FunnelSession;
use Ramsey\Uuid\Uuid;
use Application\Entity\Settings;

class MotorService
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
     * @var GeneralService
     */
    private $generalService;

    /**
     * Undocumented variable
     *
     * @var UploadService
     */
    private $uploadService;

    /**
     * Avaialable User Session
     *
     * @var FunnelSession
     */
    private $funnelSession;

    /**
     * Undocumented variable
     *
     * @var TransactionService
     */
    private $transactionService;


    /**
     * Undocumented variable
     *
     * @var Settings
     */
    private $companySettings;


    const COVER_TYPE_THIRD_PARTY = 100;

    const COVERT_TYPE_COMPREHENSIVE = 200;



    public function thirdparty($data)
    {
        if (!$this->funnelSession->isExist()) {
            throw new \Exception("Identity absent");
        } else {

            $motorEntity = new MotorInsurance();
            $entityManager = $this->entityManager;
            $sessionUid = $this->funnelSession->getSessionUid();
            $userEntity = $entityManager->getRepository(User::class)->findOneBy([
                "uuid" => $sessionUid
            ]);
            $em = $this->entityManager;
            $uploadService = $this->uploadService;
            try {
                $vl = $uploadService->upload($data["license"]);
                $motorEntity->setVehicleLicense($entityManager->find(Uploads::class, $vl->getId()));

                $own = $uploadService->upload($data["ownership"]);
                $motorEntity->setProofOfOwnership($entityManager->find(Uploads::class, $own->getId()));

                $motorEntity->setCreatedOn(new \Datetime())
                    ->setCoverType($entityManager->find(MotorinsuranceCoverType::class, self::COVER_TYPE_THIRD_PARTY))
                    ->setUid(self::motorUid())->setUser($userEntity)->setUuid(Uuid::uuid4())->setIsActive(TRUE);

                $amountPayable = $this->companySettings->getThirdPartyRate();
                $data["amount"] = $amountPayable;
                $data["user"] = $userEntity;
                $data["desc"] = "Premium payment for third party Motor insurance service";
                $invoiceEntity =  $this->transactionService->generateInvoice($data);

                $motorEntity->setinvoice($invoiceEntity);

                $em->persist($motorEntity);
                $em->persist($invoiceEntity);

                $em->flush();

                $invoice['uuid'] = $invoiceEntity->getInvoiceUuid();
                $motor["uuid"] = $motorEntity->getUuid();
                $response["invoice"] = $invoice;
                $response["motor"] = $motor;


                return $response;
            } catch (\Throwable $th) {
                throw new \Exception($th->getMessage());
            }
        }
    }



    public function comprehensive($data)
    {
        if (!$this->funnelSession->isExist()) {
            throw new \Exception("Please login");
        } else {

            $motorEntity = new MotorInsurance();
            $entityManager = $this->entityManager;
            $sessionUid = $this->funnelSession->getSessionUid();
            $userEntity = $entityManager->getRepository(User::class)->findOneBy([
                "uuid" => $sessionUid
            ]);
            $em = $this->entityManager;
            $uploadService = $this->uploadService;
            try {
                $vl = $uploadService->upload($data["license"]);
                $motorEntity->setVehicleLicense($entityManager->find(Uploads::class, $vl->getId()));

                $own = $uploadService->upload($data["proofOfOwnership"]);
                $motorEntity->setProofOfOwnership($entityManager->find(Uploads::class, $own->getId()));

                $md = $uploadService->upload($data["meansOfId"]);
                $motorEntity->setMeansOfId($entityManager->find(Uploads::class, $md->getId()));

                $fi = $uploadService->upload($data["frontImage"]);
                $motorEntity->setFrontImage($entityManager->find(Uploads::class, $fi->getId()));

                $bi = $uploadService->upload($data["backImage"]);
                $motorEntity->setBackImage($entityManager->find(Uploads::class, $bi->getId()));

                $im = $uploadService->upload($data["interiorImage"]);
                $motorEntity->setInteriorImage($entityManager->find(Uploads::class, $im->getId()));

                $dm = $uploadService->upload($data["dashboardImage"]);
                $motorEntity->setDashboardImage($entityManager->find(Uploads::class, $dm->getId()));

                $motorEntity->setValueOfCar($data["valueOfCar"])->setLicenseNumber($data["vNumber"]);

                $motorEntity->setCreatedOn(new \Datetime())
                    ->setCoverType($entityManager->find(MotorinsuranceCoverType::class, self::COVERT_TYPE_COMPREHENSIVE))
                    ->setUid(self::motorUid())->setUser($userEntity)->setUuid(Uuid::uuid4())->setIsActive(TRUE);

                $amountPayable = $this->standardComprehensivePremium($data["valueOfCar"]);
                $data["amount"] = $amountPayable;
                $data["user"] = $userEntity;
                $data["desc"] = "Premium payment for Comprehensive Motor insurance service";
                $invoiceEntity =  $this->transactionService->generateInvoice($data);

                $motorEntity->setInvoice($invoiceEntity);

                $em->persist($motorEntity);
                $em->persist($invoiceEntity);

                $em->flush();

                $invoice['uuid'] = $invoiceEntity->getInvoiceUuid();
                $motor["uuid"] = $motorEntity->getUuid();
                $response["invoice"] = $invoice;
                $response["motor"] = $motor;


                return $response;
            } catch (\Throwable $th) {
                throw new \Exception($th->getMessage());
            }
        }
    }


    public function standardComprehensivePremium($data)
    {
        $premiumRatio = $this->companySettings->getComprehensiveRate();
        $premiumValue = ($premiumRatio * $data) / 100;
        return number_format((float)$premiumValue, 2, '.', '');
    }

    public static function motorUid()
    {
        return Uuid::uuid4();
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
     * Get the value of generalService
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     * Set the value of generalService
     *
     * @return  self
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;

        return $this;
    }

    /**
     * Get the value of uploadService
     */
    public function getUploadService()
    {
        return $this->uploadService;
    }

    /**
     * Set the value of uploadService
     *
     * @return  self
     */
    public function setUploadService($uploadService)
    {
        $this->uploadService = $uploadService;

        return $this;
    }

    /**
     * Set avaialable User Session
     *
     * @param  FunnelSession  $funnelSession  Avaialable User Session
     *
     * @return  self
     */
    public function setFunnelSession(FunnelSession $funnelSession)
    {
        $this->funnelSession = $funnelSession;

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
     * @return  Settings
     */
    public function getCompanySettings()
    {
        return $this->companySettings;
    }

    /**
     * Set undocumented variable
     *
     * @param  Settings  $companySettings  Undocumented variable
     *
     * @return  self
     */
    public function setCompanySettings(Settings $companySettings)
    {
        $this->companySettings = $companySettings;

        return $this;
    }
}
