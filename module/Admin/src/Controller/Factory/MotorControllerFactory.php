<?php

namespace Admin\Controller\Factory;

use Admin\Controller\MotorController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MotorControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $generalService = $container->get("general_service");

        $ctr =  new MotorController();
        $ctr->setEntityManager($generalService->getEm());
        return $ctr;
    }
}
