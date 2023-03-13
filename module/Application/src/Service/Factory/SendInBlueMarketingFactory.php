<?php

namespace Application\Service\Factory;

use Application\Service\SendInBlueMarketing;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use SendinBlue\Client\Configuration;

class SendInBlueMarketingFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new SendInBlueMarketing();
        $config = $container->get("config");
        // var_dump($config["send-in-blue"]["key"]);
        $credentials = Configuration::getDefaultConfiguration()->setApiKey("api-key", $config["send-in-blue"]["key"]);
        // $sendInBlueinstance = 
        $xserv->setCredentials($credentials);
        return $xserv;
    }
}