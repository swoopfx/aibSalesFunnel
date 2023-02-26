<?php

namespace Application\Service;

use Laminas\Session\Container;

class FunnelSession
{


    /**
     * Undocumented variable
     *
     * @var Container
     */
    private $funnelSession;

    const FUNNEL_IDENTITY = "xgmxKQ7eNK48EhzguGWE
    SHCqZz4yZteVy9UGGCuN
    FtTiePPdEcXMdwbxTNFV
    dpaPbcM7UJv6PjRAc4Lx
    SAEdbnd6CLZwFePiqWvH
    WSEpZWWd38P59ZGTFMXb
    iUZUD653gbwff5XukFHC
    eDRjzYr7H4MdMQq8JxZ9
    JrJn6mNaKyKeFmkcHrEv
    uDQxZiUFaP32kJUc7UvD
    YGwhJ9VG6tYFaHpHdY2J
    ayGjtPMc9EZer36xgtVy
    9Gj3Npf8JPcbF7iHRY6R
    qbM4fTVKr2BqGKiZxBg5
    83kWP6vqefLgbqD8p5Xh
    yVtpJqvDQZAZ8e4F42Vj";


    public function __construct()
    {
        $funnelSession = new Container(self::FUNNEL_IDENTITY);
        $funnelSession->setExpirationSeconds(43200);
        $this->funnelSession = $funnelSession;
    }


    public function createSession($data)
    {
        $this->funnelSession->offsetSet("igibber", $data["uuid"]);
        $this->funnelSession->offsetSet("igibbername", $data["name"]);
        // $this->funnelSession->igibber = $data;
        return $this;
    }


    public function isExist()
    {
        return ($this->funnelSession->offsetExists("igibber") && $this->funnelSession->offsetExists("igibbername"));
    }


    public function getSessionUid()
    {
        return $this->funnelSession->offsetGet("igibber");
    }

    public function getSessionName(){
        return $this->funnelSession->offsetGet("igibbername");
    }



    public function closeSession(){
        $this->funnelSession->offsetUnset("igibbername");
        $this->funnelSession->offsetUnset("igibber");
    }


    /**
     * Get the value of funnelSession
     */
    public function getFunnelSession()
    {
        return $this->funnelSession;
    }
}
