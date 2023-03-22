<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="settings")
 */

class Settings
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $companyName;

    /**
     * @ORM\Column(nullable=false)
     *
     * @var string
     */
    private $companyLogo;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @var string
     */
    private $companyAddress;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @var string
     */
    private $companyEmail;

    /**
     * Undocumented variable
     * @ORM\Column(type="string", nullable=false)
     *
     * @var string
     */
    private $thirdPartyRate;


    /**
     * Undocumented variable
     * @ORM\Column(type="string", nullable=false)
     *
     * @var string
     */
    private $comprehensiveRate;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true, type="text")
     *
     * @var string
     */
    private $paystackKey;

    /**
     * Pay
     * @ORM\Column(nullable=true, type="text")
     * @var string
     */
    private $paystackSecret;

    /**
     * This is the registered email of mail sender on
     * platforms like sendInBlue
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $companyEmailSender;

    /**
     * Undocumented variable
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $baseUrl;

    // private 


    // private $


    /**
     * Get the value of companyName
     *
     * @return  string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set the value of companyName
     *
     * @param  string  $companyName
     *
     * @return  self
     */
    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get @ORM\Column(name="id", type="integer", nullable=false)
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of companyEmail
     *
     * @return  string
     */
    public function getCompanyEmail()
    {
        return $this->companyEmail;
    }

    /**
     * Set the value of companyEmail
     *
     * @param  string  $companyEmail
     *
     * @return  self
     */
    public function setCompanyEmail(string $companyEmail)
    {
        $this->companyEmail = $companyEmail;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getThirdPartyRate()
    {
        return $this->thirdPartyRate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $thirdPartyRate  Undocumented variable
     *
     * @return  self
     */
    public function setThirdPartyRate(string $thirdPartyRate)
    {
        $this->thirdPartyRate = $thirdPartyRate;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getComprehensiveRate()
    {
        return $this->comprehensiveRate;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $comprehensiveRate  Undocumented variable
     *
     * @return  self
     */
    public function setComprehensiveRate(string $comprehensiveRate)
    {
        $this->comprehensiveRate = $comprehensiveRate;

        return $this;
    }

    /**
     * Get the value of companyLogo
     *
     * @return  string
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     * Set the value of companyLogo
     *
     * @param  string  $companyLogo
     *
     * @return  self
     */
    public function setCompanyLogo(string $companyLogo)
    {
        $this->companyLogo = $companyLogo;

        return $this;
    }

    /**
     * Get the value of companyAddress
     *
     * @return  string
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * Set the value of companyAddress
     *
     * @param  string  $companyAddress
     *
     * @return  self
     */
    public function setCompanyAddress(string $companyAddress)
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    public function getPaystackKey()
    {
        return $this->paystackKey;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $paystackKey  Undocumented variable
     *
     * @return  self
     */
    public function setPaystackKey(string $paystackKey)
    {
        $this->paystackKey = $paystackKey;

        return $this;
    }

    /**
     * Get pay
     *
     * @return  string
     */
    public function getPaystackSecret()
    {
        return $this->paystackSecret;
    }

    /**
     * Set pay
     *
     * @param  string  $paystackSecret  Pay
     *
     * @return  self
     */
    public function setPaystackSecret(string $paystackSecret)
    {
        $this->paystackSecret = $paystackSecret;

        return $this;
    }

    /**
     * Get platforms like sendInBlue
     *
     * @return  string
     */ 
    public function getCompanyEmailSender()
    {
        return $this->companyEmailSender;
    }

    /**
     * Set platforms like sendInBlue
     *
     * @param  string  $companyEmailSender  platforms like sendInBlue
     *
     * @return  self
     */ 
    public function setCompanyEmailSender(string $companyEmailSender)
    {
        $this->companyEmailSender = $companyEmailSender;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $baseUrl  Undocumented variable
     *
     * @return  self
     */ 
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }
}
