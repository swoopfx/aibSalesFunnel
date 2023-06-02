<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Identification;
use Application\Entity\UserCategory;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */

class User
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Undocumented variable
     *
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $fullname;

    /**
     * @ORM\Column(length=30, nullable=false, unique=true)
     */
    protected $phonenumber;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Application\Entity\UserCategory")
     * @var UserCategory
     */
    protected $userCategory;


    /**
     * @ORM\Column(length=30, nullable=false, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="password", length=100, nullable=true)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Roles")
     * 
     * @var Roles
     */
    private $role;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=true)
     * 
     */
    protected $registrationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="registration_token", type="string", length=121, nullable=true)
     */
    protected $registrationToken;

    /**
     * @var bool
     *
     * @ORM\Column(name="email_confirmed", type="boolean", nullable=false)
     */
    protected $emailConfirmed;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \Datetime
     */
    protected $createdOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \Datetime
     */
    protected $updatedOn;

    /**
     * @ORM\Column(nullable=false)
     * @var string
     */

    private $uuid;

    /**
     * This is the activce idenfier being used 
     * @ORM\ManyToOne(targetEntity="Identification")
     * @var Identification
     */
    private $identifier;

    /**
     * Undocumented variable
     * @ORM\Column(type="boolean", nullable=true, options={"default" : 0})
     * @var bool
     */
    private $isIdentifier;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default" : 0})
     *
     * @var boolean
     */
    private $isActive;






    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of phonenumber
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Set the value of phonenumber
     *
     * @return  self
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $fullname  Undocumented variable
     *
     * @return  self
     */
    public function setFullname(string $fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get the value of role
     *
     * @return  Roles
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  Roles  $role
     *
     * @return  self
     */
    public function setRole(Roles $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of registrationDate
     *
     * @return  \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set the value of registrationDate
     *
     * @param  \DateTime  $registrationDate
     *
     * @return  self
     */
    public function setRegistrationDate(\DateTime $registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get the value of registrationToken
     *
     * @return  string
     */
    public function getRegistrationToken()
    {
        return $this->registrationToken;
    }

    /**
     * Set the value of registrationToken
     *
     * @param  string  $registrationToken
     *
     * @return  self
     */
    public function setRegistrationToken(string $registrationToken)
    {
        $this->registrationToken = $registrationToken;

        return $this;
    }

    /**
     * Get the value of emailConfirmed
     *
     * @return  boolean
     */
    public function getEmailConfirmed()
    {
        return $this->emailConfirmed;
    }

    /**
     * Set the value of emailConfirmed
     *
     * @param  boolean  $emailConfirmed
     *
     * @return  self
     */
    public function setEmailConfirmed(bool $emailConfirmed)
    {
        $this->emailConfirmed = $emailConfirmed;

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
     * Get undocumented variable
     *
     * @return  boolean
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

    /**
     * Get the value of Uuid
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of Uuid
     *
     * @return  self
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Identification
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set undocumented variable
     *
     * @param  Identification  $identifier  Undocumented variable
     *
     * @return  self
     */
    public function setIdentifier(Identification $identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  boolean
     */
    public function getIsIdentifier()
    {
        return $this->isIdentifier;
    }

    /**
     * Set undocumented variable
     *
     * @param  boolean  $isIdentifier  Undocumented variable
     *
     * @return  self
     */
    public function setIsIdentifier(bool $isIdentifier)
    {
        $this->isIdentifier = $isIdentifier;

        return $this;
    }
}
