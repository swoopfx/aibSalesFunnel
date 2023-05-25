<?php

namespace Application\Service\Factory;

use Application\Service\TwilioSendgridService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use SendGrid;

class TwilioSendgridServiceFactory implements FactoryInterface
{


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new TwilioSendgridService();
        $config = $container->get("config");
        $twilioConfig = $config["twilio"];
        $sendgridClient = new SendGrid($twilioConfig["key"]);
        // var_dump($sendgridClient);
        // var_dump($twilioConfig);
        // $ser = new  SendGrid
        $xserv->setTwilioConfig($twilioConfig)->setSendgridClient($sendgridClient);
        return $xserv;
    }
}
