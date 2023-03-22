<?php

namespace Application\Controller\Factory;

use Application\Controller\IndexController;
use Application\Form\RegisterInputFilter;
use Application\Service\MotorService;
use Laminas\InputFilter\InputFilterPluginManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class IndexControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr =  new IndexController();
        $generalService = $container->get("general_service");
        $paystackService = $container->get("paystack_service");
        $funnelSession = $container->get("funnel_session");
        $inputfilterPlugin = $container->get(InputFilterPluginManager::class);
        $registerInputFilter = $inputfilterPlugin->get(RegisterInputFilter::class);
        $motorService = $container->get(MotorService::class);
        $ctr->setEntityManager($generalService->getEm())
            ->setMotorService($motorService)->setRegisterInputFilter($registerInputFilter)
            ->setFunnelSession($funnelSession);

        return $ctr;
    }
}
