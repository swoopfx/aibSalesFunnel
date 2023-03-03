<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This counl be Schegen, 
 * @ORM\Entity
 * @ORM\Table(name="travel_variant")
 */

class TravelInsuranceVariant {
     /**
     *
     * @var integer 
     * @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Travel Variant
     * @ORM\Column(name="variant", nullable=false)
     * @var string
     */
    private $variant;

    /**
     * Descrition of the variant
     * @ORM\Column(name="description11", type="text", nullable=false)
     * @var string
     */
    private $description;


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
     * Get travel Variant
     *
     * @return  string
     */ 
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * Set travel Variant
     *
     * @param  string  $variant  Travel Variant
     *
     * @return  self
     */ 
    public function setVariant(string $variant)
    {
        $this->variant = $variant;

        return $this;
    }

    /**
     * Get descrition of the variant
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set descrition of the variant
     *
     * @param  string  $description  Descrition of the variant
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }
}