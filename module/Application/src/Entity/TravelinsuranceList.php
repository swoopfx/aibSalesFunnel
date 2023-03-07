<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="travel_insurance_list")
 */

class TravelinsuranceList {


     /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    private $categroy;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $surname;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $firstname;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $passport;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Gender")
     * @var Gender
     */
    private $gender;

    /**
     * Undocumented variable
     * @ORM\Column(type="date", nullable=true)
     * @var \Datetime
     */
    private $dob;

    /**
     * Undocumented variable
     * @ORM\Column(type="datetime", nullable=false)
     * @var \Datetime
     */
    private $createdOn;

    /**
     * Undocumented variable
     * @ORM\Column(type="datetime", nullable=true)
     * @var \Datetime
     */
    private $updatedOn;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="TravelInsurance", inversedBy="travelList")
     * @var 
     */
    private $travelInsurance;

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $surname  Undocumented variable
     *
     * @return  self
     */ 
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $firstname  Undocumented variable
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

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
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $passport  Undocumented variable
     *
     * @return  self
     */ 
    public function setPassport(string $passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set undocumented variable
     *
     * @param  Gender  $gender  Undocumented variable
     *
     * @return  self
     */ 
    public function setGender(Gender $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  \Datetime
     */ 
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set undocumented variable
     *
     * @param  \Datetime  $dob  Undocumented variable
     *
     * @return  self
     */ 
    public function setDob(\Datetime $dob)
    {
        $this->dob = $dob;

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
        $this->updatedOn = $createdOn;
        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  \Datetime
     */ 
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set undocumented variable
     *
     * @param  \Datetime  $updatedOn  Undocumented variable
     *
     * @return  self
     */ 
    public function setUpdatedOn(\Datetime $updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    public function getTravelInsurance(){
        return $this->travelInsurance;
    }


    public function setTravelInsurance($insurance){
        $this->travelInsurance = $insurance;
        return $this;
    }
}