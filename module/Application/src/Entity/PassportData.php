<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="passport_data")
 */

class PassportData
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private  $id;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @var User
     */
    private $user;

    /**
     * Undocumented variable
     * @ORM\Column(type="string")
     * @var string
     */
    private $uuid;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $passportId;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $passportNo;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $firstname;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $lastname;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $middlename;


    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $birthdate;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $gender;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $phone;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $issuedAt;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $issuedDate;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $expiryDate;

    /**
     * Undocumented variable
     * @ORM\Column(type="datetime")
     * @var \Datetime
     */
    private $createdOn;

    /**
     * Undocumented variable
     * @ORM\Column(type="datetime")
     * @var \Datetime
     */
    private $updatedOn;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get undocumented variable
     *
     * @return  User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set undocumented variable
     *
     * @param  User  $user  Undocumented variable
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $uuid  Undocumented variable
     *
     * @return  self
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getPassportNo()
    {
        return $this->passportNo;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $passportNo  Undocumented variable
     *
     * @return  self
     */
    public function setPassportNo(string $passportNo)
    {
        $this->passportNo = $passportNo;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getPassportId()
    {
        return $this->passportId;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $passportId  Undocumented variable
     *
     * @return  self
     */
    public function setPassportId(string $passportId)
    {
        $this->passportId = $passportId;

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
     * Get undocumented variable
     *
     * @return  string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $lastname  Undocumented variable
     *
     * @return  self
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $middlename  Undocumented variable
     *
     * @return  self
     */
    public function setMiddlename(string $middlename)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $birthdate  Undocumented variable
     *
     * @return  self
     */
    public function setBirthdate(string $birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $gender  Undocumented variable
     *
     * @return  self
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $phone  Undocumented variable
     *
     * @return  self
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getIssuedAt()
    {
        return $this->issuedAt;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $issuedAt  Undocumented variable
     *
     * @return  self
     */
    public function setIssuedAt(string $issuedAt)
    {
        $this->issuedAt = $issuedAt;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getIssuedDate()
    {
        return $this->issuedDate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $issuedDate  Undocumented variable
     *
     * @return  self
     */
    public function setIssuedDate(string $issuedDate)
    {
        $this->issuedDate = $issuedDate;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $expiryDate  Undocumented variable
     *
     * @return  self
     */
    public function setExpiryDate(string $expiryDate)
    {
        $this->expiryDate = $expiryDate;

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
}
