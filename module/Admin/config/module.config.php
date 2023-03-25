<?php

namespace Admin;

use Admin\Controller\AdminController;
use Admin\Controller\AuthController;
use Admin\Controller\Factory\AdminControllerFactory;
use Admin\Controller\Factory\AuthControllerFactory;
use Application\Entity\User;
use Application\Service\Factory\AuthenticationFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Authentication\AuthenticationService;
use Laminas\Router\Http\Segment;

return [
    "router" => [
        "routes" => [

            'admin' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => [
                        'controller' => AdminController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'admin-auth' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/auth-admin[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
        ]
    ],
    "view_manager" => [
        'template_map' => [
            "layout/admin" => __DIR__ . '/../view/layout/adminlayout.phtml',
            "layout/admin-login" => __DIR__ . '/../view/layout/adminlogin.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    "controllers" => [
        "factories" => [
            AdminController::class => AdminControllerFactory::class,
            AuthController::class => AuthControllerFactory::class

        ]
    ],
    "service_manager" => [
        "factories" => [
            AuthenticationService::class => AuthenticationFactory::class,
        ]
    ],
    'doctrine' => [
        // 'doctrine' => [
        //     'authentication' => [
        //         'orm_default' => [
        //             'object_manager' => EntityManager::class,
        //             // 'identity_class' => User::class,
        //             'identity_property' => 'username',
        //             'credential_property' => 'password',
        //             'credential_callable' => "Authentication\Service\AuthenticationService::verifyHashedPassword"
        //         ],
        //     ],
        // ],

        'configuration' => array(
            'orm_default' => array(
                'generate_proxies' => true
            )
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => EntityManager::class,
                'identity_class' => User::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => 'Application\Service\UserService::verifyHashedPassword'
            )
        ),

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
