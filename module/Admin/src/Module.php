<?php

namespace Admin;

use Laminas\ModuleManager\ModuleManager;

class Module
{
    public function getConfig()
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

    // public function init(ModuleManager $moduleManager)
    // {
    //     $sharedEvent = $moduleManager->getEventManager()->getSharedManager();
    //     $sharedEvent->attach(__NAMESPACE__, 'dispatch', function ($e) {
    //         $controller = $e->getTarget();
    //         $controller->layout('layout/admin');
    //     });
    // }
}
