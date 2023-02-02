<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="selected_service")
 */
class SelectedService {

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
     * @ORM\ManytoOne(targetEntity="AvailaibleService")
     *
     * @var AvailaibleService
     */
    private $selectedService;

    /**
     * @ORM\ManyToOne(targetEntity="Insurer")
     *
     * @var Insurer
     */
    private $insurer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \Datetime
     */
    private $createdOn;

     /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \Datetime
     */
    private $transaction;

    /**
     * 
     *
     * @var [type]
     */
    private $serviceStatus;


    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default" : 1})
     *
     * @var bool
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $updatedOn;


    public function getId(){
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
     * Get the value of selectedService
     *
     * @return  AvailaibleService
     */ 
    public function getSelectedService()
    {
        return $this->selectedService;
    }

    /**
     * Set the value of selectedService
     *
     * @param  AvailaibleService  $selectedService
     *
     * @return  self
     */ 
    public function setSelectedService(AvailaibleService $selectedService)
    {
        $this->selectedService = $selectedService;

        return $this;
    }

    /**
     * Get the value of insurer
     *
     * @return  Insurer
     */ 
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     * Set the value of insurer
     *
     * @param  Insurer  $insurer
     *
     * @return  self
     */ 
    public function setInsurer(Insurer $insurer)
    {
        $this->insurer = $insurer;

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

        return $this;
    }

    /**
     * Get the value of isActive
     *
     * @return  bool
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @param  bool  $isActive
     *
     * @return  self
     */ 
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;

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