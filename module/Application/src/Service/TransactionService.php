<?php

namespace Application\Service;

use Application\Entity\Invoice;
use Application\Entity\InvoiceStatus;
use Application\Entity\Transaction;
use Application\Entity\TransactionStatus;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;
use Application\Service\MailService;
use Exception;

class TransactionService
{



    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    private $generalService;

    /**
     * Undocumented variable
     *
     * @var MailService
     */
    private $mailService;

    const INVOICE_STATUS_INITIATED = 10;

    const INVOICE_STATUS_SETTLED = 100;

    const INVOICE_STATUS_UNSETTLED = 200;

    const INVOICE_STATUS_CANCELLED = 500;

    const MAIL_SUBJECT_SUCCESS = "Transaction Success";

    const TRANSACTION_STATUS_SUCCESS = 100;

    const TRANSACTION_STATUS_FAILED = 200;

    public function generateInvoice($data)
    {
        $invoiceEntity = new Invoice();
        $entityManager = $this->entityManager;

        $invoiceEntity->setAmount($data['amount'])
            ->setCreatedOn(new \Datetime())
            ->setInvoiceUuid(self::invoiceUuid())
            ->setInvoiceUid(self::invoiceUid())
            ->setDescription($data["desc"])
            ->setIsOpen(TRUE)
            ->setUser($data["user"])
            ->setStatus($entityManager->find(InvoiceStatus::class, self::INVOICE_STATUS_INITIATED))
            ->setGeneratedOn(new \Datetime());

        $entityManager->persist($invoiceEntity);
        return $invoiceEntity;
    }


    public function finalizeSuccessfulTransaction($data)
    {
        try {
            $em = $this->entityManager;
            /**
             * @var Invoice
             */
            $invoiceEntity = $em->getRepository(Invoice::class)->findOneBy([
                "invoiceUuid" => $data["invoice"]
            ]);
            if ($invoiceEntity != null) {

                $transactionEntity = new Transaction();
                $transactionEntity->setInvoiceId($invoiceEntity)
                    ->setCreatedOn(new \Datetime())
                    ->setTransactionUid(uniqid("trans"))
                    ->setPaystackRef($data["pRef"])
                    ->setTransactionRef(Uuid::uuid4())
                    ->setTransactionStatus($em->find(TransactionStatus::class, self::TRANSACTION_STATUS_SUCCESS))
                    ->setPaystackTransaction($data["pTrans"]);

                $invoiceEntity->setStatus($em->find(InvoiceStatus::class, self::INVOICE_STATUS_SETTLED));

                $em->persist($invoiceEntity);
                $em->persist($transactionEntity);

                // Send email notification for successful transaaction 
                // $mailData["to"] = $invoiceEntity->getUser()->getEmail();
                // $mailData["subject"] = self::MAIL_SUBJECT_SUCCESS;
                // $mailData["toName"] = $invoiceEntity->getUser()->getFullname();
                // $mailData["template"] = "transaction-success-email";
                // $mailData["var"] = [
                //     "delivery_to" => $invoiceEntity->getUser()->getFullname(),
                //     "amount" => $invoiceEntity->getAmount(),
                //     "tRef" => $transactionEntity->getTransactionUid(),
                //     "description" => $invoiceEntity->getDescription(),
                //     "company_name" => $data["company_name"],
                //     "company_address" => $data["company_address"],
                //     "company_email" => $data["company_email"],
                //     "company_logo" => $data["company_logo"],

                // ];
                // $this->mailService->execute($mailData);


                $em->flush();
            }
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    private static function invoiceUid()
    {
        return uniqid("inv");
    }

    private static function invoiceUuid()
    {
        return Uuid::uuid4();
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
     * Get the value of mailService
     */
    public function getMailService()
    {
        return $this->mailService;
    }

    /**
     * Set the value of mailService
     *
     * @return  self
     */
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;

        return $this;
    }
}
