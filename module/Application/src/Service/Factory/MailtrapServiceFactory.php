<?php

namespace  Application\Service\Factory;

use Application\Service\MailtrapService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MailtrapServiceFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new MailtrapService();
        $config = $container->get("config");
        $mailtrapConfig = $config["mailtrap"];
        $xserv->setMailtrapconfig($mailtrapConfig);
        return $xserv;
    }
}