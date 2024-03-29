<?php

namespace Application\Controller\Factory;

use Application\Controller\MotorController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MotorControllerFactory implements FactoryInterface
{


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new MotorController();
        $generalService = $container->get("general_service");
        $funnelSession = $container->get("funnel_session");
        $motorService = $container->get("motor_service");
        $ctr->setEntityManager($generalService->getEm())->setFunnelSession($funnelSession)->setMotorService($motorService);
        return $ctr;
    }
}
