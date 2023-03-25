<?php

namespace Admin\Controller\Factory;

use Admin\Controller\AuthController;
use Laminas\Authentication\AuthenticationService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AuthControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new AuthController();
        $generalService = $container->get("general_service");
        $authService = $container->get(AuthenticationService::class);
        $ctr->setEntityManager($generalService->getEm())->setAuthService($authService); 

        return $ctr;
    }
}
