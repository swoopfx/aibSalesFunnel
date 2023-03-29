<?php

namespace Admin\Controller\Plugin\Factory;

use Admin\Controller\Plugin\RedirectPlugin;
use Application\Service\GeneralService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class RedirectPluginFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $plugin = new RedirectPlugin();
        /**
         * @var GeneralService
         */
        $generalService = $container->get("general_service");
        $redirectManager = $container->get('ControllerPluginManager')
            ->get('redirect');
        $authService = $generalService->getAuthService();
        $plugin->setAuth($authService)->setRedirect($redirectManager);
        return $plugin;
    }
}
