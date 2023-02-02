<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


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
     * Either Thrid Party, comprehensive or custom
     * @ORM\ManyToOne(targetEntity="MotorinsuranceCoverType")
     * @var MotorinsuranceCoverType
     */
    private $coverType;

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


    public function addVehicleImage($image){
        if(!$this->vehicleImage->contains($image)){
            $this->vehicleImage->add($image);
        
        }
        return $this;
    }


    public function removeVehicleImage($image){
        if($this->vehicleImage->contains($image)){
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
}
