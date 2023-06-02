<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company_data")
 */


class CompanyData {

     /**
     *
     * @var int @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $companyId;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $companyName;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $companyType;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $registrationDate;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $branchAddress;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $companyEmail;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $city;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $officeAddress;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $lga;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $affiliates;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $state;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $status;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true, type="datetime")
     * @var string
     */
    private $createdOn;

     /**
     * Undocumented variable
     * @ORM\Column(nullable=true, type="datetime")
     * @var string
     */
    private $updatedOn;




    /**
     * Get @ORM\Column(name="id", type="integer", nullable=false)
     *
     * @return  int
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
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $companyId  Undocumented variable
     *
     * @return  self
     */ 
    public function setCompanyId(string $companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $companyName  Undocumented variable
     *
     * @return  self
     */ 
    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $companyType  Undocumented variable
     *
     * @return  self
     */ 
    public function setCompanyType(string $companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $registrationDate  Undocumented variable
     *
     * @return  self
     */ 
    public function setRegistrationDate(string $registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getBranchAddress()
    {
        return $this->branchAddress;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $branchAddress  Undocumented variable
     *
     * @return  self
     */ 
    public function setBranchAddress(string $branchAddress)
    {
        $this->branchAddress = $branchAddress;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getCompanyEmail()
    {
        return $this->companyEmail;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $companyEmail  Undocumented variable
     *
     * @return  self
     */ 
    public function setCompanyEmail(string $companyEmail)
    {
        $this->companyEmail = $companyEmail;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $city  Undocumented variable
     *
     * @return  self
     */ 
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getOfficeAddress()
    {
        return $this->officeAddress;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $officeAddress  Undocumented variable
     *
     * @return  self
     */ 
    public function setOfficeAddress(string $officeAddress)
    {
        $this->officeAddress = $officeAddress;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getLga()
    {
        return $this->lga;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $lga  Undocumented variable
     *
     * @return  self
     */ 
    public function setLga(string $lga)
    {
        $this->lga = $lga;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getAffiliates()
    {
        return $this->affiliates;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $affiliates  Undocumented variable
     *
     * @return  self
     */ 
    public function setAffiliates(string $affiliates)
    {
        $this->affiliates = $affiliates;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $state  Undocumented variable
     *
     * @return  self
     */ 
    public function setState(string $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $status  Undocumented variable
     *
     * @return  self
     */ 
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $createdOn  Undocumented variable
     *
     * @return  self
     */ 
    public function setCreatedOn(string $createdOn)
    {
        $this->createdOn = $createdOn;
        $this->updatedOn = $createdOn;
        return $this;
    }
}