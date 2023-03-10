<?php

namespace Application\Service;

use Application\Entity\Invoice;
use Application\Entity\InvoiceStatus;
use Application\Entity\Transaction;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;

class TransactionService
{



    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    private $generalService;

    const INVOICE_STATUS_INITIATED = 10;
   
    const INVOICE_STATUS_SETTLED = 100;

    const INVOICE_STATUS_UNSETTLED = 200;

    const INVOICE_STATUS_CANCELLED = 500;

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


    public function finalizeSuccessfulTransaction($invoiceUid){
        $em = $this->entityManager;
        /**
         * @var Invoice
         */
        $invoiceEntity = $em->getRepository(Invoice::class)->findOneBy([
            "invoiceUuid"=>$invoiceUid
        ]);
        if($invoiceEntity != null){
            $transactionEntity = new Transaction();
            // $transactionEntity->setInvoiceId($invoiceEntity->getId())->set
            
            // $invoiceEntity->setTr
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
}
