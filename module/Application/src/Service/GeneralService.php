<?php
namespace Application\Service;

use Application\Entity\Settings;
use Doctrine\ORM\EntityManager;


class GeneralService {


    const COMPANY_NAME = "Advocate Insurance Brokers";

    const COMPANY_URL = "https://aibltd.insure/";

    const COMPANY_ADDRESS = "27a Babatunde Jose Off Adetokunbo Ademola, VI Lagos";


    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $em;

    private $mail;

    private $authService;

    /**
     * Undocumented function
     *
     * @return Settings
     */
    private $companySettings;

    
    public function getSettings(){
      return  $this->em->find(Settings::class, 1);
    }

    /**
     * Get the value of em
     */ 
    public function getEm()
    {
        return $this->em;
    }

    /**
     * Set the value of em
     *
     * @return  self
     */ 
    public function setEm($em)
    {
        $this->em = $em;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of authService
     */ 
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Set the value of authService
     *
     * @return  self
     */ 
    public function setAuthService($authService)
    {
        $this->authService = $authService;

        return $this;
    }

    /**
     * Get undocumented function
     */ 
    public function getCompanySettings()
    {
        return $this->companySettings;
    }

    /**
     * Set undocumented function
     *
     * @return  self
     */ 
    public function setCompanySettings($companySettings)
    {
        $this->companySettings = $companySettings;

        return $this;
    }
}