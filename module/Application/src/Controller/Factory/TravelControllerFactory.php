<?php


namespace Application\Controller\Factory;

use Application\Controller\TravelController;
use Application\Form\TravelInputFIlter;
use Application\Service\TravelService;
use Laminas\InputFilter\InputFilterPluginManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TravelControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new TravelController();
        $generalService = $container->get("general_service");
        $funnelSession = $container->get("funnel_session");
        $travelService = $container->get(TravelService::class);
        $inputfilterPlugin = $container->get(InputFilterPluginManager::class);
        $travelInputFilter = $inputfilterPlugin->get(TravelInputFIlter::class);
        $ctr->setEntityManager($generalService->getEm())
            ->setGeneralService($generalService)
            ->setTravelInputFilter($travelInputFilter)
            ->setFunnelSession($funnelSession)
            ->setTravelService($travelService);

        return $ctr;
    }
}
