<?php

namespace Application\Service;

use Laminas\Session\Container;

class FunnelSession {


    private $funnelSession;


    public function __construct()
    {
        $funnelSession = new Container('aib-funnel');
        $funnelSession->setExpirationSeconds(43200);
        $this->funnelSession = $funnelSession;
    }

    /**
     * Get the value of funnelSession
     */ 
    public function getFunnelSession()
    {
        return $this->funnelSession;
    }

    
}