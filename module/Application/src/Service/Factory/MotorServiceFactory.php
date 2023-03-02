<?php

namespace Application\Service\Factory;

use Application\Service\MotorService;
use Application\Service\TransactionService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Application\Service\GeneralService;

class MotorServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new MotorService();
        /**
         * @var GeneralService
         */
        $generalService = $container->get("general_service");
        $funnelSession = $container->get("funnel_session");
        $xserv->setGeneralService($generalService)
            ->setEntityManager($generalService->getEm())
            ->setUploadService($container->get("upload_service"))
            ->setTransactionService($container->get(TransactionService::class))
            ->setCompanySettings($generalService->getCompanySettings())
            ->setFunnelSession($funnelSession);
        return $xserv;
    }
}
