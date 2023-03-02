<?php

namespace Application\Service\Factory;

use Application\Entity\Settings;
use Application\Service\GeneralService;
use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class GeneralServiceFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {

        $xserv = new GeneralService();

        $em = $container->get(EntityManager::class);
        // $authService = $container->get("authentication_service");
        $companySetting = $em->find(Settings::class, 1);
        $xserv->setEm($em)->setCompanySettings($companySetting);
        // ->setAuthService($authService);
        return $xserv;
        
    }
}