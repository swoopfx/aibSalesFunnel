<?php

namespace Application\Service\Factory;

use Application\Service\MailService;
use Application\Service\MailtrapService;
use Application\Service\TransactionService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TransactionServiceFactory implements FactoryInterface
{


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new TransactionService();
        $generalService = $container->get("general_service");
        $mailService = $container->get(MailService::class);
        $mailtrap = $container->get(MailtrapService::class);
        // $mailService = $container->get('acmailer.mailservice.default');
        $xserv->setEntityManager($generalService->getEm())->setMailService($mailService)->setMailtrap($mailtrap);
        return $xserv;
    }
}
