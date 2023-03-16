<?php

namespace Application\Service\Factory;

use Application\Service\MailService;
use Laminas\Mail\Transport\Smtp as SmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MailServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserve = new MailService();
        $config = $container->get("config");
        $generalService = $container->get("general_service");
        $transport = new SmtpTransport();
        $sendInBlueMailConfig = $config["send-in-blue"];
        $options = new SmtpOptions([
            "name" => $sendInBlueMailConfig["name"],
            "host" => $sendInBlueMailConfig["host"],
            "port" => $sendInBlueMailConfig["port"],
            "connection_class" => "",
            "connection_config" => [
                "username" => $sendInBlueMailConfig["username"],
                "password" => $sendInBlueMailConfig["password"],
            ]
        ]);
        $viewRenderer = $container->get("ViewRenderer");
        $xserve->setSmtpOptions($options)
            ->setSmtpTransport($transport)
            ->setViewRenderer($viewRenderer)
            ->setEntityManager($generalService->getEm());
        return $xserve;
    }
}
