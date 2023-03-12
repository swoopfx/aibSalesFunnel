<?php

namespace Admin\Controller\Factory;

use Admin\Controller\AdminController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AdminControllerFactory implements FactoryInterface{


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new AdminController();
        $generalService = $container->get("general_service");
        $ctr->setEntityManager($generalService->getEm());
        return $ctr;
    }
}