<?php

namespace Application\Controller\Factory;

use Application\Controller\AppController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AppControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        //  var_dump("uuuuu");
        $ctr = new AppController();
        // var_dump("uuuuu");
        $generalService = $container->get("general_service");
        $ctr
            ->setVerifyMeService($container->get("verify_me_service"))
            ->setEntityManager($generalService->getEm());
        return $ctr;
    }
}
