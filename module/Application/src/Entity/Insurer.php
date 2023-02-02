<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="insurer")
 */
class Insurer
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(nullable=false)
     *
     * @var string
     */
    private $name;

     /**
     * @ORM\Column(nullable=false)
     *
     * @var string
     */
    private $alias;

     /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var boolean
     */
    private $isActive;

     /**
     * @ORM\Column(nullable=false, unique=true)
     *
     * @var string
     */
    private $insurerUid;

     /**
     * @ORM\Column(nullable=false)
     *
     * @var string
     */
    private $logo;

     /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var Datetime
     */
    private $createdOn;

    /**
     * 
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     *
     * @param  integer  $id  
     * 
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     *
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     *
     * @param  string  $name  ORM\Column(nullable=false)
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * 
     *
     * @return  string
     */ 
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param 
     *
     * @return  self
     */ 
    public function setAlias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * 
     *
     * @return  boolean
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * 
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
     * 
     *
     * @return  string
     */ 
    public function getInsurerUid()
    {
        return $this->insurerUid;
    }

    /**
     * 
     *
     * @param  string  $insurerUid 
     *
     * @return  self
     */ 
    public function setInsurerUid(string $insurerUid)
    {
        $this->insurerUid = $insurerUid;

        return $this;
    }

    /**
     * 
     *
     * @return  string
     */ 
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * 
     *
     * @param  string  $logo  
     *
     * @return  self
     */ 
    public function setLogo(string $logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * 
     *
     * @return  Datetime
     */ 
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * 
     *
     * @param  Datetime  $createdOn  
     *
     * @return  self
     */ 
    public function setCreatedOn(string $createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }
}
