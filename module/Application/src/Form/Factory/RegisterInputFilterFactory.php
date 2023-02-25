<?php

namespace Application\Form\Factory;

use Application\Form\RegisterInputFilter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Application\Service\GeneralService;

class RegisterInputFilterFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new RegisterInputFilter();
        /**
         * @var GeneralService
         * 
         */
        $generalService = $container->get("general_service");
        $xserv->setEntityManager($generalService->getEm());
        return $xserv;
    }
}