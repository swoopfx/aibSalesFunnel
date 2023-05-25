<?php

namespace Application\Service;

use Application\Service\GeneralService;
use Doctrine\ORM\EntityManager;
use Application\Entity\Settings;

class VerifyMeService
{
    /**
     * Undocumented variable
     *
     * @var GeneralService
     */
    private $generalService;

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Undocumented variable
     *
     * @var Settings
     */
    private $settings;

    private $qoreIdPayload;


    /**
     * Get undocumented variable
     *
     * @return  GeneralService
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     * Set undocumented variable
     *
     * @param  GeneralService  $generalService  Undocumented variable
     *
     * @return  self
     */
    public function setGeneralService(GeneralService $generalService)
    {
        $this->generalService = $generalService;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set undocumented variable
     *
     * @param  EntityManager  $entityManager  Undocumented variable
     *
     * @return  self
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set undocumented variable
     *
     * @param  Settings  $settings  Undocumented variable
     *
     * @return  self
     */
    public function setSettings(Settings $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get the value of qoreIdPayload
     */
    public function getQoreIdPayload()
    {
        return $this->qoreIdPayload;
    }

    /**
     * Set the value of qoreIdPayload
     *
     * @return  self
     */
    public function setQoreIdPayload($qoreIdPayload)
    {
        $this->qoreIdPayload = $qoreIdPayload;

        return $this;
    }
}
