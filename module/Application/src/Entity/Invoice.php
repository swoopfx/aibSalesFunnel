<?php

namespace Application\Entity;


/**
 * @ORM\Entity
 * @ORM\Table(name="invoice")
 */

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Invoice
{

    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     *
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(nullable=false, unique=true)
     *
     * @var string
     */
    private $invoiceUuid;

    /**
     * The date the invoice eas generated
     * @var \DateTime @ORM\Column(name="generated_on", type="datetime", nullable=true)
     */
    private $generatedOn;

    /**
     * The amount meant to be transacted
     * @var string @ORM\Column(name="amount", type="string")
     */
    private $amount;


    /**
     * Undocumented variable
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $description;



    /**
     * The related transaction or reciept on successful payment or unsccessful Payment
     * @var Collection @ORM\OneToMany(targetEntity="Application\Entity\Transaction", mappedBy="invoice", cascade={"persist", "remove"})
     */
    private $transaction;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var Datetime
     */
    private $createdOn;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $updatedOn;

    /**
     * 
     * @var string 
     * @ORM\Column(name="invoice_uid", type="string", nullable=false, unique=true)
     */
    private $invoiceUid;

    

    /**
     * @ORM\ManyToOne(targetEntity="InvoiceStatus")
     *
     * @var InvoiceStatus
     */
    private $status;

    // /**
    //  *
    //  * @var \Settings\Entity\Currency @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
    //  *      @ORM\JoinColumns({
    //  *      @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
    //  *      })
    //  *     
    //  *     
    //  *     
    //  */
    // private $currency;

    /**
     *
     * @var \DateTime @ORM\Column(name="modified_on", type="datetime", nullable=true)
     */
    private $modifiedOn;



    /**
     * This defines it the invoice is still valid /open for payment if
     * Invoice is Closed there will be no link to payout
     *
     * @var boolean 
     * @ORM\Column(name="is_open", type="boolean", nullable=true, options={"default":true})
     */
    private $isOpen = true;


    public function __construct()
    {
        $this->transaction = new ArrayCollection();
    }

    /**
     * Get this is only genertated upon successful transaction
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of user
     *
     * @return  User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get @ORM\Column(name="generated_on", type="datetime", nullable=true)
     *
     * @return  \DateTime
     */
    public function getGeneratedOn()
    {
        return $this->generatedOn;
    }

    /**
     * Set @ORM\Column(name="generated_on", type="datetime", nullable=true)
     *
     * @param  \DateTime  $generatedOn  @ORM\Column(name="generated_on", type="datetime", nullable=true)
     *
     * @return  self
     */
    public function setGeneratedOn(\DateTime $generatedOn)
    {
        $this->generatedOn = $generatedOn;

        return $this;
    }

    /**
     * Get @ORM\Column(name="invoice_uid", type="string", nullable=false)
     *
     * @return  string
     */
    public function getInvoiceUid()
    {
        return $this->invoiceUid;
    }

    /**
     * Set @ORM\Column(name="invoice_uid", type="string", nullable=false)
     *
     * @param  string  $invoiceUid  @ORM\Column(name="invoice_uid", type="string", nullable=false)
     *
     * @return  self
     */
    public function setInvoiceUid(string $invoiceUid)
    {
        $this->invoiceUid = $invoiceUid;

        return $this;
    }

    /**
     * Get @ORM\Column(name="modified_on", type="datetime", nullable=true)
     *
     * @return  \DateTime
     */
    public function getModifiedOn()
    {
        return $this->modifiedOn;
    }

    /**
     * Set @ORM\Column(name="modified_on", type="datetime", nullable=true)
     *
     * @param  \DateTime  $modifiedOn  @ORM\Column(name="modified_on", type="datetime", nullable=true)
     *
     * @return  self
     */
    public function setModifiedOn(\DateTime $modifiedOn)
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }



    /**
     * Get the value of createdOn
     *
     * @return  Datetime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set the value of createdOn
     *
     * @param  Datetime  $createdOn
     *
     * @return  self
     */
    public function setCreatedOn(\Datetime $createdOn)
    {
        $this->createdOn = $createdOn;
        $this->updatedOn = $createdOn;
        return $this;
    }

    /**
     * Get @ORM\Column(name="amount", type="string")
     *
     * @return  string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set @ORM\Column(name="amount", type="string")
     *
     * @param  string  $amount  @ORM\Column(name="amount", type="string")
     *
     * @return  self
     */
    public function setAmount(string $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  bool  $status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get invoice is Closed there will be no link to payout
     *
     * @return  boolean
     */
    public function getIsOpen()
    {
        return $this->isOpen;
    }

    /**
     * Set invoice is Closed there will be no link to payout
     *
     * @param  boolean  $isOpen  Invoice is Closed there will be no link to payout
     *
     * @return  self
     */
    public function setIsOpen(bool $isOpen)
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    /**
     * Get the value of updatedOn
     *
     * @return  \Datetime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set the value of updatedOn
     *
     * @param  \Datetime  $updatedOn
     *
     * @return  self
     */
    public function setUpdatedOn(\Datetime $updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get the value of invoiceUuid
     *
     * @return  string
     */
    public function getInvoiceUuid()
    {
        return $this->invoiceUuid;
    }

    /**
     * Set the value of invoiceUuid
     *
     * @param  string  $invoiceUuid
     *
     * @return  self
     */
    public function setInvoiceUuid(string $invoiceUuid)
    {
        $this->invoiceUuid = $invoiceUuid;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $description  Undocumented variable
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }
}
