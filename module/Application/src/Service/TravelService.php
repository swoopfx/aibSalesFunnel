<?php

namespace Application\Service;

use Application\Entity\Country;
use Application\Entity\Gender;
use Application\Entity\TravelInsurance;
use Application\Entity\TravelinsuranceList;
use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Application\Service\TransactionService;
use DateTime;
use Ramsey\Uuid\Uuid;

class TravelService
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


    private $funnelSession;







    const DATE_FORMAT = "Y-m-d";
    // individual Shengen young pricing
    const INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_3_DAYS = 3000;
    const INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_6_DAYS = 3900;
    const INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_15_DAYS = 5850;
    const INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_31_DAYS = 9100;
    const INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_61_DAYS = 16000;
    const INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_92_DAYS = 23000;
    const INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_180_DAYS = 25000;
    const INDIVIDUAL_SHENGEN_YOUNG_ONE_YEAR = 30800;


    // individual old shengen pricing
    const INDIVIDUAL_SHENGEN_OLD_LESS_THAN_3_DAYS = 4500;
    const INDIVIDUAL_SHENGEN_OLD_LESS_THAN_6_DAYS = 5850;
    const INDIVIDUAL_SHENGEN_OLD_LESS_THAN_15_DAYS = 8775;
    const INDIVIDUAL_SHENGEN_OLD_LESS_THAN_31_DAYS = 13650;
    const INDIVIDUAL_SHENGEN_OLD_LESS_THAN_61_DAYS = 24300;
    const INDIVIDUAL_SHENGEN_OLD_LESS_THAN_92_DAYS = 34500;
    const INDIVIDUAL_SHENGEN_OLD_LESS_THAN_180_DAYS = 37800;
    const INDIVIDUAL_SHENGEN_OLD_ONE_YEAR = 46200;

    const INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_3_DAYS = 4200;
    const INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_6_DAYS = 4940;
    const INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_15_DAYS = 7410;
    const INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_31_DAYS = 11440;
    const INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_61_DAYS = 20280;
    const INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_92_DAYS = 33840;
    const INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_180_DAYS = 44280;
    const INDIVIDUAL_NON_SHENGEN_YOUNG_ONE_YEAR = 60000;


    public function initiateTravelinsurance($data)
    {
        if (!$this->funnelSession->isExist()) {
            throw new \Exception("Please login");
        } else {

            $em = $this->entityManager;
            $payableIndividualPrice = $this->calculateIndividualTravelFee($data);
            $payableListPrice = $this->calculateListPrice($data, $payableIndividualPrice);
            $totalPrice = $payableIndividualPrice + $payableListPrice;
            $userEntity = $em->getRepository(User::class)->findOneBy([
                "uuid" => $data["user"]
            ]);
            $travelEntity = new TravelInsurance();
            $destination = $em->find(Country::class, $data["destination"]);
            $travelEntity->setCreatedOn(new \DateTime())
                ->setUser($userEntity)
                ->setIsActive(TRUE)
                ->setTravelUuid(Uuid::uuid4())
                ->setDepartureDate(DateTime::createFromFormat(self::DATE_FORMAT, $data["departureDate"]))
                ->setReturnDate(\DateTime::createFromFormat(self::DATE_FORMAT, $data["returnDate"]))
                ->setDestination($destination)
                ->setNationality($em->find(Country::class, $data["nationality"]))
                ->setDob(\DateTime::createFromFormat(self::DATE_FORMAT, $data["dob"]))
                ->setTravelUid(self::genrateTravelUid());
            if ($data["travelList"] != "") {
                $travelList = json_decode($data["travelList"]);
                foreach ($travelList as $listee) {
                    $travelListEntity = new TravelinsuranceList();
                    $travelListEntity->setSurname($listee->surname)
                        ->setFirstname($listee->firstname)
                        ->setPassport($listee->passport)
                        ->setDob(\DateTime::createFromFormat(self::DATE_FORMAT, $listee->dob))
                        ->setGender($em->find(Gender::class, $listee->gender))
                        ->setTravelInsurance($travelEntity);

                    $em->persist($travelListEntity);
                }
            }

            $invoiceData["amount"] = $totalPrice;
            $invoiceData["user"] = $userEntity;
            $invoiceData["desc"] = "Premium payment for travel insurance by {$userEntity->getFullname()} to  {$destination->getName()}";
            $data["invcode"] = "QTV";
            $invoiceEntity = $this->transactionService->generateInvoice($invoiceData);
            // $invoiceEntity->setInvoiceUid($invoiceEntity->getInvoiceUid()."QT");
            
            $travelEntity->setInvoice($invoiceEntity);
            // $em->persist($invoiceEntity);
            $em->persist($travelEntity);
            $em->flush();

            $invoice['uuid'] = $invoiceEntity->getInvoiceUuid();
            $travel["uuid"] = $travelEntity->getTravelUuid();
            $response["invoice"] = $invoice;
            $response["travel"] = $travel;
            return $response;
        }
    }

    public static function genrateTravelUid()
    {
        return uniqid("travel");
    }



    /**
     * Undocumented function
     *
     * @return float
     */
    private function calculateIndividualTravelFee($data): float
    {
        $travelFee = 0;
        $age = $this->ageOfPrincipal($data);
        // var_dump($age);
        $travelDuration = $this->durationOfTravel($data);
        $absTravelDuration = intval(abs($travelDuration));
        switch (true) {
            case ($data["destination"] == intval('74')):
            case ($data["destination"] == intval('81')):
            case ($data["destination"] == intval('105')):
            case ($data["destination"] == intval('150')):
            case ($data["destination"] == intval('98')):
            case ($data["destination"] == intval('124')):
            case ($data["destination"] == intval('21')):
            case ($data["destination"] == intval('203')):
            case ($data["destination"] == intval('57')):
            case ($data["destination"] == intval('84')):
            case ($data["destination"] == intval('72')):
            case ($data["destination"] == intval('160')):
            case ($data["destination"] == intval('195')):
            case ($data["destination"] == intval('171')):
            case ($data["destination"] == intval('189')):
            case ($data["destination"] == intval('190')):
            case ($data["destination"] == intval('132')):
            case ($data["destination"] == intval('123')):
            case ($data["destination"] == intval('117')):
            case ($data["destination"] == intval('97')):
            case ($data["destination"] == intval('67')):
            case ($data["destination"] == intval('56')):
            case ($data["destination"] == intval('14')):
            case ($data["destination"] == intval('204')):
            case ($data["destination"] == intval('170')):
            case ($data["destination"] == intval('193')):
                // Shengen Countries

                if ($age < 71) {

                    switch (true) {
                        case ($absTravelDuration <= 3):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_3_DAYS;
                            # code...
                            break;

                        case (1 < $absTravelDuration && $absTravelDuration <= 6):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_6_DAYS;
                            break;

                        case (7 <= $absTravelDuration && $absTravelDuration <= 15):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_15_DAYS;
                            break;

                        case (16 <= $absTravelDuration && $absTravelDuration <= 31):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_31_DAYS;
                            break;

                        case (32 <= $absTravelDuration && $absTravelDuration <= 61):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_61_DAYS;
                            break;

                        case (62 <= $absTravelDuration && $absTravelDuration <= 92):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_92_DAYS;
                            break;
                        case (93 <= $absTravelDuration && $absTravelDuration <= 180):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_LESS_THAN_180_DAYS;
                            break;

                        case ($absTravelDuration > 180):
                            return self::INDIVIDUAL_SHENGEN_YOUNG_ONE_YEAR;
                            break;

                        default:
                            # code...
                            break;
                    }
                } else { // Old status
                    switch (true) {
                        case ($absTravelDuration <= 3):
                            return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_3_DAYS;
                            # code...
                            break;

                        case (1 < $absTravelDuration && $absTravelDuration <= 6):
                            return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_6_DAYS;
                            break;

                        case (7 <= $absTravelDuration && $absTravelDuration <= 15):
                            return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_15_DAYS;
                            break;

                        case (16 <= $absTravelDuration && $absTravelDuration <= 31):
                            return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_31_DAYS;
                            break;

                        case (32 <= $absTravelDuration && $absTravelDuration <= 61):
                            return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_61_DAYS;
                            break;

                        case (62 <= $absTravelDuration && $absTravelDuration <= 92):
                            return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_92_DAYS;
                            break;
                        case (93 <= $absTravelDuration && $absTravelDuration <= 180):
                            return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_180_DAYS;
                            break;
                        case ($absTravelDuration > 180):
                            return self::INDIVIDUAL_SHENGEN_OLD_ONE_YEAR;
                            break;

                        default:
                            throw new \Exception("System could not calculate basic fee");
                            break;
                    }
                }
                break;

            default:

                // if ($age < 71) {

                switch (true) {
                    case ($absTravelDuration <= 3):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_3_DAYS;
                        # code...
                        break;

                    case (1 < $absTravelDuration && $absTravelDuration <= 6):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_6_DAYS;
                        break;

                    case (7 <= $absTravelDuration && $absTravelDuration <= 15):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_15_DAYS;
                        break;

                    case (16 <= $absTravelDuration && $absTravelDuration <= 31):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_31_DAYS;
                        break;

                    case (32 <= $absTravelDuration && $absTravelDuration <= 61):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_61_DAYS;
                        break;

                    case (62 <= $absTravelDuration && $absTravelDuration <= 92):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_92_DAYS;
                        break;
                    case (93 <= $absTravelDuration && $absTravelDuration <= 180):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_LESS_THAN_180_DAYS;
                        break;

                    case ($absTravelDuration > 180):
                        return self::INDIVIDUAL_NON_SHENGEN_YOUNG_ONE_YEAR;
                        break;

                    default:
                        throw new \Exception("System could not calculate basic fee");
                        break;
                }
                // } else { // Old status
                //     switch (true) {
                //         case ($absTravelDuration <= 3):
                //             return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_3_DAYS;
                //             # code...
                //             break;

                //         case (1 < $absTravelDuration && $absTravelDuration <= 6):
                //             return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_6_DAYS;
                //             break;

                //         case (7 <= $absTravelDuration && $absTravelDuration <= 15):
                //             return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_15_DAYS;
                //             break;

                //         case (16 <= $absTravelDuration && $absTravelDuration <= 31):
                //             return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_31_DAYS;
                //             break;

                //         case (32 <= $absTravelDuration && $absTravelDuration <= 61):
                //             return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_61_DAYS;
                //             break;

                //         case (62 <= $absTravelDuration && $absTravelDuration <= 92):
                //             return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_92_DAYS;
                //             break;
                //         case (93 <= $absTravelDuration && $absTravelDuration <= 180):
                //             return self::INDIVIDUAL_SHENGEN_OLD_LESS_THAN_180_DAYS;
                //             break;
                //         case ($absTravelDuration > 180):
                //             return self::INDIVIDUAL_SHENGEN_OLD_ONE_YEAR;
                //             break;

                //         default:
                //             # code...
                //             break;
                //     }
                // }

                # code...
                break;
        }
        return doubleval($travelFee);
    }

    private function calculateListPrice($data, $individualPrice)
    {
        // var_dump($data["travelList"]);
        if(!is_null($data["travelList"])){
            $numberOfList = count($data["tavelList"]);
            if ($numberOfList > 0) {
                return $numberOfList * $individualPrice;
            } else {
                return 0;
            }
        }
       
    }

    private function durationOfTravel($data)
    {
        $returnDate = \DateTime::createFromFormat(self::DATE_FORMAT, $data["returnDate"]);
        return \DateTime::createFromFormat(self::DATE_FORMAT, $data["departureDate"])->diff($returnDate)->days;
    }

    private function ageOfPrincipal($data)
    {
        // var_dump(\DateTime::createFromFormat(self::DATE_FORMAT, $data["dob"])->diff(new \DateTime('now')));
        return  \DateTime::createFromFormat(self::DATE_FORMAT, $data["dob"])->diff(new \DateTime('now'))->y;
    }

    // private function 

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
     * Get the value of funnelSession
     */ 
    public function getFunnelSession()
    {
        return $this->funnelSession;
    }

    /**
     * Set the value of funnelSession
     *
     * @return  self
     */ 
    public function setFunnelSession($funnelSession)
    {
        $this->funnelSession = $funnelSession;

        return $this;
    }
}
