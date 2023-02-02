<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="available_service")
 */
class AvailaibleService
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Name of service
     * @ORM\Column(nullable=false)
     *
     * @var string
     */
    private $serviceName;

    /**
     * Insuring Company
     * @ORM\ManyToMany(targetEntity="Application\Entity\Insurer")
     * @ORM\JoinTable(name="availaible_service_insurer", 
     * joinColumns={
     * @ORM\JoinColumn(name="available_service_id",  referencedColumnName="id")
     * }, 
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="insurer_id", referencedColumnName="id" )
     * }
     * )
     * @var Collection Insurer
     */
    private $providingInsurers;

    /**
     * Undocumented variable
     * @ORM\Column(type="datetime", nullable=false)
     * @var \Datetime
     */
    private $createdOn;


    public function __construct()
    {

        $this->providingInsurers = new ArrayCollection();
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
     * Get name of service
     *
     * @return  string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Set name of service
     *
     * @param  string  $serviceName  Name of service
     *
     * @return  self
     */
    public function setServiceName(string $serviceName)
    {
        $this->serviceName = $serviceName;

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


    public function addProvidingInsurers()
    {
        if($this->providingInsurers->contains()){
            
        }
    }


    public function removeProvidingInsurers()
    {
    }
}
