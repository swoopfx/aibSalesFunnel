<?php

namespace Application\Controller\Factory;

use Application\Controller\IndexController;
use Application\Service\MotorService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class IndexControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr =  new IndexController();
        $generalService = $container->get("general_service");
        $paystackService = $container->get("paystack_service");
        $motorService = $container->get(MotorService::class);
        $ctr->setEntityManager($generalService->getEm())->setMotorService($motorService);

        return $ctr;
    }
}
