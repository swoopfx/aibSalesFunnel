<?php

namespace Admin;

use Admin\Controller\AdminController;
use Admin\Controller\AuthController;
use Admin\Controller\Factory\AdminControllerFactory;
use Admin\Controller\Factory\AuthControllerFactory;
use Admin\Controller\Factory\InvoiceControllerFactory;
use Admin\Controller\Factory\MotorControllerFactory;
use Admin\Controller\Factory\TravelControllerFactory;
use Admin\Controller\InvoiceController;
use Admin\Controller\MotorController;
use Admin\Controller\Plugin\Factory\RedirectPluginFactory;
use Admin\Controller\Plugin\RedirectPlugin;
use Admin\Controller\TravelController;
use Admin\ViewHelper\InvoiceStatus;
use Application\Entity\User;
use Application\Service\Factory\AuthenticationFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Authentication\AuthenticationService;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

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

            'admin-motor' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/motor-admin[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => [
                        'controller' => MotorController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'admin-travel' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/travel-admin[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => [
                        'controller' => TravelController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'admin-invoice' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/invoice-admin[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => [
                        'controller' => InvoiceController::class,
                        'action'     => 'index ',
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

            'login' => array(
                'type' => Literal::class,
                'options' => array(
                    'route' => '/admin/login',
                    'defaults' => array(
                        // '__NAMESPACE__' => 'CsnUser\Controller',
                        'controller' => AuthController::class,
                        'action' => 'login'
                    )
                )
            ),

            'logout' => array(
                'type' => Literal::class,
                'options' => array(
                    'route' => '/admin/logout',
                    'defaults' => array(

                        'controller' => AuthController::class,
                        'action' => 'logout'
                    )
                )
            ),
        ]
    ],
    "view_manager" => [
        'template_map' => [
            "layout/admin" => __DIR__ . '/../view/layout/adminlayout.phtml',
            "layout/admin-login" => __DIR__ . '/../view/layout/adminlogin.phtml',
            "customer-invoice-partial" => __DIR__ . '/../view/partial/customer-invoice-partial.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    "controllers" => [
        "factories" => [
            AdminController::class => AdminControllerFactory::class,
            AuthController::class => AuthControllerFactory::class,
            MotorController::class => MotorControllerFactory::class,
            TravelController::class => TravelControllerFactory::class,
            InvoiceController::class => InvoiceControllerFactory::class

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
    'controller_plugins' => [
        "factories" => [
            "redirectPlugin" => RedirectPluginFactory::class
        ]
    ],

    "view_helpers" => [
        "factories" => [
            InvoiceStatus::class => InvokableFactory::class,
        ],
        "aliases" => [
            "adminInvoiceStatus" => InvoiceStatus::class
        ]

    ]
];
