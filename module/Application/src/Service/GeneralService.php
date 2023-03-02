<?php
namespace Application\Service;

use Application\Entity\Settings;


class GeneralService {


    private $em;

    private $mail;

    private $authService;

    /**
     * Undocumented function
     *
     * @return Settings
     */
    private $companySettings;

    

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