<?php

namespace Application\Service\Factory;

use Application\Service\FunnelSession;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Session\Config\SessionConfig;
use Laminas\Session\Container;
use Laminas\Session\SessionManager;
use Psr\Container\ContainerInterface;

class FunnelSessionFactory implements FactoryInterface {


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new FunnelSession();
        // $sessionConfig = new SessionConfig();
        // $sessionConfig->setOptions([
        //     'remember_me_seconds' => 43200, // 12 hours 
        //     'name'                => 'aib-funnel',
        // ]);
        // $sessionManager = new SessionManager($sessionConfig);
        // Container::setDefaultManager($sessionManager);
       
        // $xserv->setFunnelSession($funnelSession);
        return $xserv;
    }
}