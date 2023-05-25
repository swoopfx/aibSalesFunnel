<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This is Bike< Trailer , etc
 * 
 * @ORM\Entity
 * @ORM\Table(name="motor_category")
 */

class MotorCategory
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
     */
    private $category;

    /**
     * Benefits of the insurance 
     * @ORM\Column(nullable=false, type="text")
     * @var string
     */
    private $benefits;

    /**
     * The thrid party premium rate
     * @ORM\Column(nullable=false, length="50")
     * @var string
     */
    private $thirdpartyPremium;

    /**
     * Comprehensive premium percentage
     * @ORM\Column(nullable=false, length="50")
     * @var string
     */
    private $comprehensiveRate;

    /**
     * Sample Image of product 
     * @ORM\Column(nullable=false, length="200")
     * @var string
     */
    private $sampleImage;

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
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
     * Get benefits of the insurance
     *
     * @return  string
     */
    public function getBenefits()
    {
        return $this->benefits;
    }

    /**
     * Set benefits of the insurance
     *
     * @param  string  $benefits  Benefits of the insurance
     *
     * @return  self
     */
    public function setBenefits(string $benefits)
    {
        $this->benefits = $benefits;

        return $this;
    }

    /**
     * Get the thrid party premium rate
     *
     * @return  string
     */
    public function getThirdpartyPremium()
    {
        return $this->thirdpartyPremium;
    }

    /**
     * Set the thrid party premium rate
     *
     * @param  string  $thirdpartyPremium  The thrid party premium rate
     *
     * @return  self
     */
    public function setThirdpartyPremium(string $thirdpartyPremium)
    {
        $this->thirdpartyPremium = $thirdpartyPremium;

        return $this;
    }

    /**
     * Get comprehensive premium percentage
     *
     * @return  string
     */
    public function getComprehensiveRate()
    {
        return $this->comprehensiveRate;
    }

    /**
     * Set comprehensive premium percentage
     *
     * @param  string  $comprehensiveRate  Comprehensive premium percentage
     *
     * @return  self
     */
    public function setComprehensiveRate(string $comprehensiveRate)
    {
        $this->comprehensiveRate = $comprehensiveRate;

        return $this;
    }

    /**
     * Get sample Image of product
     *
     * @return  string
     */
    public function getSampleImage()
    {
        return $this->sampleImage;
    }

    /**
     * Set sample Image of product
     *
     * @param  string  $sampleImage  Sample Image of product
     *
     * @return  self
     */
    public function setSampleImage(string $sampleImage)
    {
        $this->sampleImage = $sampleImage;

        return $this;
    }
}
