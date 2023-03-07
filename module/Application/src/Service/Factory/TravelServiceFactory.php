<?php

namespace Application\Service\Factory;

use Application\Service\TransactionService;
use Application\Service\TravelService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TravelServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new TravelService();
        $generalService = $container->get("general_service");
        $transactionService = $container->get(TransactionService::class);
        $xserv->setEntityManager($generalService->getEm())->setTransactionService($transactionService);
        return $xserv;
    }
}
