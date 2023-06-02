<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gets a list of identification processes used on Verify.me 
 * @ORM\Entity
 * @ORM\Table(name="identfication")
 */

class Identification
{

    /**
     *
     * @var integer 
     * @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $type;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true, type="text")
     * @var string
     */
    private $description;

    /**
     * Undocumented variable
     * @ORM\Column(type="datetime", nullable=true)
     * @var string
     */
    private $createdOn;


    public function __construct()
    {
        $this->createdOn = new \Datetime("mow");
    }

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

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $description  Undocumented variable
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $type  Undocumented variable
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }
}
