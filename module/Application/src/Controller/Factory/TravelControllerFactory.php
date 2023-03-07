<?php


namespace Application\Controller\Factory;

use Application\Controller\TravelController;
use Application\Form\TravelInputFIlter;
use Laminas\InputFilter\InputFilterPluginManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TravelControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new TravelController();
        $generalService = $container->get("general_service");
        $inputfilterPlugin = $container->get(InputFilterPluginManager::class);
        $travelInputFilter = $inputfilterPlugin->get(TravelInputFIlter::class);
        $ctr->setEntityManager($generalService->getEm())->setGeneralService($generalService)->setTravelInputFilter($travelInputFilter);

        return $ctr;
    }
}
