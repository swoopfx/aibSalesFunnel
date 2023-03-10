<?php

namespace Admin\Controller\Factory;

use Admin\Controller\TravelController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TravelControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new TravelController();
        $generalService = $container->get("general_service");
        $ctr->setEntityManager($generalService->getEm());
        return $ctr;
    }
}
