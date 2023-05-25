<?php

namespace Application\Controller\Factory;

use Application\Controller\AuthController;
use Application\Form\LoginInputFilter;
use Application\Form\RegisterInputFilter;
use Application\Service\GeneralService;
use Application\Service\TwilioSendgridService;
use Laminas\InputFilter\InputFilterPluginManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AuthControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $ctr = new AuthController();
        /**
         * @var GeneralService
         */
        $generalService = $container->get("general_service");
        $funnelSession = $container->get("funnel_session");
        $sendInBlue = $container->get("send_in_blue");
        $em = $generalService->getEm();
        $inputfilterPlugin = $container->get(InputFilterPluginManager::class);
        $registerInputFilter = $inputfilterPlugin->get(RegisterInputFilter::class);
        $loginInputFilter = $inputfilterPlugin->get(LoginInputFilter::class);
        $twilioSendgrid = $container->get(TwilioSendgridService::class);
        $ctr->setEntityManager($em)->setGeneralService($generalService)
            ->setRegisterInputFilter($registerInputFilter)
            ->setLoginInputFilter($loginInputFilter)
            ->setSendInBlue($sendInBlue)
            ->setTwilioSendgrid($twilioSendgrid)
            ->setFunnelSession($funnelSession);
        return $ctr;
    }
}
