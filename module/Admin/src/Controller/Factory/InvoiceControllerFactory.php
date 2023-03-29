<?php
namespace Admin\Controller\Factory;

use Admin\Controller\InvoiceController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class InvoiceControllerFactory implements FactoryInterface{


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new InvoiceController();
        $generalService = $container->get("general_service");
        $ctr->setEntityManager($generalService->getEm());
        return $ctr;
    }
}