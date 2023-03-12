<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="travel_insurance")
 */

class TravelInsurance
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
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
     * String
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $travelUid;


    /**
     * Date of birth
     * @ORM\Column(type="date", nullable=true)
     * @var \Date
     */
    private $dob;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Country")
     * @var Country
     */
    private $destination;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Country")
     *
     * @var Country
     */
    private $nationality;

    /**
     * Which is also departure 
     * @ORM\Column(type="date", nullable=false)
     * @var \Date
     */
    private $departureDate;


    /**
     * Undocumented variable
     * @ORM\Column(type="date", nullable=false)
     * @var \Date
     */
    private $returnDate;

    // /**
    //  * Expiry Date
    //  * @ORM\Column(type="date", nullable=false)
    //  * @var  \Datetime
    //  */
    // private $expireDate;

    /**
     * Undocumented variable
     * @ORM\OneToMany(targetEntity="TravelinsuranceList", mappedBy="travelInsurance")
     * @var Collection
     */
    private $travelList;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $updatedOn;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $createdOn;

    /**
     * Undocumented variable
     * @ORM\ManyToone(targetEntity="Invoice")
     * @var Invoice
     */
    private $invoice;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $travelUuid;

    /**
     * Undocumented variable
     * @ORM\Column(type="boolean", options={"default" : 1})
     * @var bool
     */
    private $isActive;


    public function __construct()
    {
        $this->travelList = new ArrayCollection();
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
     * Get string
     *
     * @return  string
     */
    public function getTravelUid()
    {
        return $this->travelUid;
    }

    /**
     * Set string
     *
     * @param  string  $travelUid  String
     *
     * @return  self
     */
    public function setTravelUid(string $travelUid)
    {
        $this->travelUid = $travelUid;

        return $this;
    }

    /**
     * Get date of birth
     *
     * @return  \Date
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set date of birth
     *
     * @param  \Date  $dob  Date of birth
     *
     * @return  self
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    // /**
    //  * Get which is also departure
    //  *
    //  * @return  \Date
    //  */
    // public function getStartDate()
    // {
    //     return $this->startDate;
    // }

    // /**
    //  * Set which is also departure
    //  *
    //  * @param  \Date  $startDate  Which is also departure
    //  *
    //  * @return  self
    //  */
    // public function setStartDate($startDate)
    // {
    //     $this->startDate = $startDate;

    //     return $this;
    // }

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
     * Get the value of destination
     *
     * @return  Zone
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set the value of destination
     *
     * @param  Country  $destination
     *
     * @return  self
     */
    public function setDestination(Country $destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Collection
     */
    public function getTravelList()
    {
        return $this->travelList;
    }

    // /**
    //  * Set undocumented variable
    //  *
    //  * @param  Collection  $travelList  Undocumented variable
    //  *
    //  * @return  self
    //  */ 
    // public function setTravelList(Collection $travelList)
    // {
    //     $this->travelList = $travelList;

    //     return $this;
    // }

    public function addTravelList(TravelinsuranceList $list)
    {
        if (!$this->travelList->contains($list)) {
            $this->travelList->add($list);
            $list->setTravelInsurance($this);
        }
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
     * Get the value of createdOn
     *
     * @return  \Datetime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set the value of createdOn
     *
     * @param  \Datetime  $createdOn
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
     * Get undocumented variable
     *
     * @return  Country
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set undocumented variable
     *
     * @param  Country  $nationality  Undocumented variable
     *
     * @return  self
     */
    public function setNationality(Country $nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get which is also departure
     *
     * @return  \Date
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * Set which is also departure
     *
     * @param  \Date  $departureDate  Which is also departure
     *
     * @return  self
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  \Date
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }

    /**
     * Set undocumented variable
     *
     * @param  \Date  $returnDate  Undocumented variable
     *
     * @return  self
     */
    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set undocumented variable
     *
     * @param  Invoice  $invoice  Undocumented variable
     *
     * @return  self
     */
    public function setInvoice(Invoice $invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getTravelUuid()
    {
        return $this->travelUuid;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $travelUuid  Undocumented variable
     *
     * @return  self
     */
    public function setTravelUuid(string $travelUuid)
    {
        $this->travelUuid = $travelUuid;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  bool
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set undocumented variable
     *
     * @param  bool  $isActive  Undocumented variable
     *
     * @return  self
     */ 
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
}
