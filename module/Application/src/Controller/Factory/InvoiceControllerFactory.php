<?php

namespace Application\Controller\Factory;

use Application\Controller\InvoiceController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class InvoiceControllerFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        
        $ctr = new InvoiceController();
        $generalService = $container->get("general_service");
        $transactionService = $container->get("transaction_service");
        $ctr->setTransactionService($transactionService)->setEntityManager($generalService->getEm()); 
        return $ctr;
    }
}