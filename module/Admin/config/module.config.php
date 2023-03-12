<?php
namespace Admin;

use Admin\Controller\AdminController;
use Admin\Controller\Factory\AdminControllerFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    "controllers"=>[
        "factories"=>[
            AdminController::class=>AdminControllerFactory::class
        ]
    ],
    'doctrine' => [
        'doctrine' => [
            'authentication' => [
                'orm_default' => [
                    'object_manager' => EntityManager::class,
                    // 'identity_class' => User::class,
                    'identity_property' => 'username',
                    'credential_property' => 'password',
                    'credential_callable' => "Authentication\Service\AuthenticationService::verifyHashedPassword"
                ],
            ],
        ],

        'driver' => [
            __NAMESPACE__ . '_driver' => array(
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ]
    ],
];
