<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="driver_license_data")
 * 
 */

class DriverLicenseData
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
     * @ORM\Column(type="string")
     * @var string
     */
    private $uuid;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $vNinId;

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
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $photo;


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
    private $issueDate;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $xpireddDate;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $issueState;

    /**
     * Undocumented variable
     *
     * @var \Datetime
     */
    private $createdOn;

    /**
     * Undocumented variable
     *
     * @var \Datetime
     */
    private $updatedOn;

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

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getIssueState()
    {
        return $this->issueState;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $issueState  Undocumented variable
     *
     * @return  self
     */
    public function setIssueState(string $issueState)
    {
        $this->issueState = $issueState;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getXpireddDate()
    {
        return $this->xpireddDate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $xpireddDate  Undocumented variable
     *
     * @return  self
     */
    public function setXpireddDate(string $xpireddDate)
    {
        $this->xpireddDate = $xpireddDate;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $issueDate  Undocumented variable
     *
     * @return  self
     */
    public function setIssueDate(string $issueDate)
    {
        $this->issueDate = $issueDate;

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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $photo  Undocumented variable
     *
     * @return  self
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;

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
    public function getVNinId()
    {
        return $this->vNinId;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $vNinId  Undocumented variable
     *
     * @return  self
     */
    public function setVNinId(string $vNinId)
    {
        $this->vNinId = $vNinId;

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
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}
