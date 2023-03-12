<?php

namespace Application\Form\Factory;

use Application\Form\RegisterInputFilter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Application\Service\GeneralService;

class RegisterInputFilterFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $generalService = $container->get("general_service");
       
        // $xserv->setEntityManager($generalService->getEm());
        $xserv = new RegisterInputFilter($generalService->getEm());
        /**
         * @var GeneralService
         * 
         */
       
        return $xserv;
    }
}