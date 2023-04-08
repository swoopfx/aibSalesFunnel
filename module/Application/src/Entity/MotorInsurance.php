<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Application\Entity\User;


/**
 * @ORM\Entity
 * @ORM\Table(name="motor_insurance")
 */
class MotorInsurance
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
     * @ORM\ManyToOne(targetEntity="User")
     * @var User
     */
    private $user;

    /**
     * Either Thrid Party, comprehensive or custom
     * @ORM\ManyToOne(targetEntity="MotorinsuranceCoverType")
     * @var MotorinsuranceCoverType
     */
    private $coverType;

    /**
     * Undocumented variable
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $uid;

    /**
     * Scanned document or liscence
     * @ORM\ManyToOne(targetEntity="Uploads")
     * @var Uploads
     */
    private $vehicleLicense;

    /**
     * Scaneed documents
     * @ORM\ManyToOne(targetEntity="Uploads")
     * @var Uploads
     */
    private $proofOfOwnership;

    /**
     * Scanned Images
     * @ORM\ManyToMany(targetEntity="Uploads")
     * @ORM\JoinTable( name="vehicle_images",
     * joinColumns={
     * @ORM\JoinColumn(name="motor_insurance_id",  referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="upload_id", referencedColumnName="id" )
     * }
     * )
     *
     * @var Collection
     */
    private Collection $vehicleImage;

    /**
     * Undocumented variable
     *
     * @ORM\ManyToOne(targetEntity="Uploads")
     * @var Uploads
     */
    private $frontImage;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Uploads")
     * @var Uploads
     */
    private $backImage;


    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Uploads")
     * @var Uploads
     */
    private $dashboardImage;

    /**
     * Undocumented variable
     * @ORM\ManyToOne(targetEntity="Uploads")
     * @var Uploads
     */
    private $interiorImage;


    // private $milag

    /**
     * Scanned Means of ID
     * @ORM\ManyToOne(targetEntity="Uploads")
     *
     * @var Uploads
     */
    private $meansOfId;

    /**
     * Value of Car
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $valueOfCar;


    /**
     * Undocumented variable
     * @ORM\COlumn(nullable=true)
     * @var string
     */
    private $licenseNumber;


    /**
     * Currency Car was bought
     * @ORM\ManyToOne(targetEntity="Currency")
     * @var Currency
     */
    private $currency;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $createdOn;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $updatedOn;


    /**
     * @ORM\ManyToOne(targetEntity="Invoice")
     *
     * @var Invoice
     */
    private $invoice;



    /**
     * Undocumented variable
     * @ORM\Column(type="boolean", options={"default" : 1})
     * @var bool
     */
    private $isActive;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $uuid;


    public function __construct()
    {
        $this->vehicleImage = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * Get either Thrid Party, comprehensive or custom
     *
     * @return  MotorinsuranceCoverType
     */
    public function getCoverType()
    {
        return $this->coverType;
    }

    /**
     * Set either Thrid Party, comprehensive or custom
     *
     * @param  MotorinsuranceCoverType  $coverType  Either Thrid Party, comprehensive or custom
     *
     * @return  self
     */
    public function setCoverType(MotorinsuranceCoverType $coverType)
    {
        $this->coverType = $coverType;

        return $this;
    }

    /**
     * Get scanned document or liscence
     *
     * @return  Uploads
     */
    public function getVehicleLicense()
    {
        return $this->vehicleLicense;
    }

    /**
     * Set scanned document or liscence
     *
     * @param  Uploads  $vehicleLicense  Scanned document or liscence
     *
     * @return  self
     */
    public function setVehicleLicense(Uploads $vehicleLicense)
    {
        $this->vehicleLicense = $vehicleLicense;

        return $this;
    }

    /**
     * Get scaneed documents
     *
     * @return  Uploads
     */
    public function getProofOfOwnership()
    {
        return $this->proofOfOwnership;
    }

    /**
     * Set scaneed documents
     *
     * @param  Uploads  $proofOfOwnership  Scaneed documents
     *
     * @return  self
     */
    public function setProofOfOwnership(Uploads $proofOfOwnership)
    {
        $this->proofOfOwnership = $proofOfOwnership;

        return $this;
    }

    /**
     * Get )
     *
     * @return  Collection
     */
    public function getVehicleImage()
    {
        return $this->vehicleImage;
    }


    public function addVehicleImage($image)
    {
        if (!$this->vehicleImage->contains($image)) {
            $this->vehicleImage->add($image);
        }
        return $this;
    }


    public function removeVehicleImage($image)
    {
        if ($this->vehicleImage->contains($image)) {
            $this->vehicleImage->removeElement($image);
        }
        return $this;
    }


    /**
     * Get scanned Means of ID
     *
     * @return  Uploads
     */
    public function getMeansOfId()
    {
        return $this->meansOfId;
    }

    /**
     * Set scanned Means of ID
     *
     * @param  Uploads  $meansOfId  Scanned Means of ID
     *
     * @return  self
     */
    public function setMeansOfId(Uploads $meansOfId)
    {
        $this->meansOfId = $meansOfId;

        return $this;
    }

    /**
     * Get value of Car
     *
     * @return  string
     */
    public function getValueOfCar()
    {
        return $this->valueOfCar;
    }

    /**
     * Set value of Car
     *
     * @param  string  $valueOfCar  Value of Car
     *
     * @return  self
     */
    public function setValueOfCar(string $valueOfCar)
    {
        $this->valueOfCar = $valueOfCar;

        return $this;
    }

    /**
     * Get currency Car was bought
     *
     * @return  Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set currency Car was bought
     *
     * @param  Currency  $currency  Currency Car was bought
     *
     * @return  self
     */
    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;

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
     * @return  Uploads
     */
    public function getFrontImage()
    {
        return $this->frontImage;
    }

    /**
     * Set undocumented variable
     *
     * @param  Uploads  $frontImage  Undocumented variable
     *
     * @return  self
     */
    public function setFrontImage(Uploads $frontImage)
    {
        $this->frontImage = $frontImage;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  [type]
     */
    public function getBackImage()
    {
        return $this->backImage;
    }

    /**
     * Set undocumented variable
     *
     * @param  [type]  $backImage  Undocumented variable
     *
     * @return  self
     */
    public function setBackImage($backImage)
    {
        $this->backImage = $backImage;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Uploads
     */
    public function getDashboardImage()
    {
        return $this->dashboardImage;
    }

    /**
     * Set undocumented variable
     *
     * @param  Uploads  $dashboardImage  Undocumented variable
     *
     * @return  self
     */
    public function setDashboardImage(Uploads $dashboardImage)
    {
        $this->dashboardImage = $dashboardImage;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Uploads
     */
    public function getInteriorImage()
    {
        return $this->interiorImage;
    }

    /**
     * Set undocumented variable
     *
     * @param  Uploads  $interiorImage  Undocumented variable
     *
     * @return  self
     */
    public function setInteriorImage(Uploads $interiorImage)
    {
        $this->interiorImage = $interiorImage;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $uid  Undocumented variable
     *
     * @return  self
     */
    public function setUid(string $uid)
    {
        $this->uid = $uid;

        return $this;
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
     * Get the value of invoice
     *
     * @return  Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set the value of invoice
     *
     * @param  Invoice  $invoice
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
    public function getLicenseNumber()
    {
        return $this->licenseNumber;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $licenseNumber  Undocumented variable
     *
     * @return  self
     */ 
    public function setLicenseNumber(string $licenseNumber)
    {
        $this->licenseNumber = $licenseNumber;

        return $this;
    }
}
