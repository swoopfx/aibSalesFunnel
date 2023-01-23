<?php

namespace Application\Service;

class FunnelSession {


    private $funnelSession;

    /**
     * Get the value of funnelSession
     */ 
    public function getFunnelSession()
    {
        return $this->funnelSession;
    }

    /**
     * Set the value of funnelSession
     *
     * @return  self
     */ 
    public function setFunnelSession($funnelSession)
    {
        $this->funnelSession = $funnelSession;

        return $this;
    }
}