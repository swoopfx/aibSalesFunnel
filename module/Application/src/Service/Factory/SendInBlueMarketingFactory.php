<?php

namespace Application\Service\Factory;

use Application\Service\SendInBlueMarketing;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class SendInBlueMarketingFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new SendInBlueMarketing();

        return $xserv;
    }
}