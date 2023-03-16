<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\TransactionStatus;

/**
 * @ORM\Entity
 * @ORM\Table(name="transaction")
 */

class Transaction
{


    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Trabsaction Reference
     * @ORM\Column(type="string", nullable=false, unique=true)
     *
     * @var string
     */
    private $transactionRef;

    /**
     * 
     * @ORM\Column(type="string", nullable=false, unique=true)
     *
     * @var  string
     */
    private $transactionUid;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Invoice")
     * @var Invoice
     */
    private $invoiceId;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $paystackRef;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $paystackTransaction;


    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="TransactionStatus")
     * @var TransactionStatus
     */
    private $transactionStatus;


    /**
     * Undocumented variable
     * @ORM\Column(type="datetime")
     * @var \Datetime
     */
    private $createdOn;



    /**
     * Get trabsaction Reference
     *
     * @return  string
     */
    public function getTransactionRef()
    {
        return $this->transactionRef;
    }

    /**
     * Set trabsaction Reference
     *
     * @param  string  $transactionRef  Trabsaction Reference
     *
     * @return  self
     */
    public function setTransactionRef(string $transactionRef)
    {
        $this->transactionRef = $transactionRef;

        return $this;
    }

    /**
     * Get @ORM\Column(name="id", type="integer")
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of transactionUid
     *
     * @return  string
     */
    public function getTransactionUid()
    {
        return $this->transactionUid;
    }

    /**
     * Set the value of transactionUid
     *
     * @param  string  $transactionUid
     *
     * @return  self
     */
    public function setTransactionUid(string $transactionUid)
    {
        $this->transactionUid = $transactionUid;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Invoice
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * Set undocumented variable
     *
     * @param  Invoice  $invoiceId  Undocumented variable
     *
     * @return  self
     */
    public function setInvoiceId(Invoice $invoiceId)
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getPaystackRef()
    {
        return $this->paystackRef;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $paystackRef  Undocumented variable
     *
     * @return  self
     */
    public function setPaystackRef(string $paystackRef)
    {
        $this->paystackRef = $paystackRef;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getPaystackTransaction()
    {
        return $this->paystackTransaction;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $paystackTransaction  Undocumented variable
     *
     * @return  self
     */
    public function setPaystackTransaction(string $paystackTransaction)
    {
        $this->paystackTransaction = $paystackTransaction;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  TransactionStatus
     */ 
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * Set undocumented variable
     *
     * @param  TransactionStatus  $transactionStatus  Undocumented variable
     *
     * @return  self
     */ 
    public function setTransactionStatus(TransactionStatus $transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  \Datetime
     */ 
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set undocumented variable
     *
     * @param  \Datetime  $createdOn  Undocumented variable
     *
     * @return  self
     */ 
    public function setCreatedOn(\Datetime $createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }
}
