<?php

declare(strict_types=1);

namespace Application;

use Application\Controller\AuthController;
use Application\Controller\Factory\AuthControllerFactory;
use Application\Controller\Factory\IndexControllerFactory;
use Application\Controller\Factory\InvoiceControllerFactory;
use Application\Controller\Factory\MotorControllerFactory;
use Application\Controller\Factory\TravelControllerFactory;
use Application\Controller\InvoiceController;
use Application\Controller\MotorController;
use Application\Controller\TravelController;
use Application\Form\Factory\RegisterInputFilterFactory;
use Application\Form\LoginInputFilter;
use Application\Form\RegisterInputFilter;
use Application\Form\TravelInputFIlter;
use Application\Service\Factory\FunnelSessionFactory;
use Application\Service\Factory\GeneralServiceFactory;
use Application\Service\Factory\MotorServiceFactory;
use Application\Service\Factory\PaystackServiceFactory;
use Application\Service\Factory\SendInBlueMarketingFactory;
use Application\Service\Factory\TransactionServiceFactory;
use Application\Service\Factory\TravelServiceFactory;
use Application\Service\Factory\UploadServiceFactory;
use Application\Service\FunnelSession;
use Application\Service\GeneralService;
use Application\Service\MotorService;
use Application\Service\PaystackService;
use Application\Service\SendInBlueMarketing;
use Application\Service\TransactionService;
use Application\Service\TravelService;
use Application\Service\UploadService;
use Application\ViewHelper\InvoiceStatusHelper;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/app[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'travel' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/travel[/:action[/:id]]',
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

            'motor' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/motor[/:action[/:id]]',
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

            'auth' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/auth[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action'     => 'index',
                    ],
                ],
            ],


            // 'bbmintraining' => array(
            //     'type' => 'Segment',
            //     'options' => array(
            //         // Change this to something specific to your module
            //         'route' => '/t[/:action[/:id]]',
            //         'defaults' => array(
            //             // Change this value to reflect the namespace in which
            //             // the controllers for your module are found
            //             '__NAMESPACE__' => 'Application\Controller',
            //             'controller' => '',
            //             'action' => 'index',
            //         ),
            //     ),
            //     'may_terminate' => true,
            //     'child_routes' => array(
            //         // This route is a sane default when developing a module;
            //         // as you solidify the routes for your module, however,
            //         // you may want to remove it and replace it with more
            //         // specific routes.
            //         'default' => array(
            //             'type' => 'Segment',
            //             'options' => array(
            //                 'route' => '[/:action[/:id][/page[/:page]]]',
            //                 'constraints' => array(
            //                     'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            //                     'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            //                     "id" => '[a-zA-Z0-9_-]*',
            //                 ),
            //                 'defaults' => array(),
            //             ),
            //         ),
            //     ),
            // ),
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class,
            AuthController::class => AuthControllerFactory::class,
            TravelController::class => TravelControllerFactory::class,
            MotorController::class => MotorControllerFactory::class,
            InvoiceController::class => InvoiceControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            "partials-rtl-menu" => __DIR__ . '/../view/partial/rtl-menu.phtml',
            "partials-top-menu" => __DIR__ . '/../view/partial/top-menu.phtml',
            "partials-form-thirdparty" => __DIR__ . '/../view/partial/thirdparty.phtml',
            "partials-form-comprehensive" => __DIR__ . '/../view/partial/comprehensive.phtml',
            "partials-form-travel" => __DIR__ . '/../view/partial/travel-form-partial.phtml',
            "partials-form-travel-list" => __DIR__ . '/../view/partial/travel-list-form-partial.phtml',
            "partials-login" => __DIR__ . '/../view/partial/login-partial.phtml',
            "partials-form-login" => __DIR__ . '/../view/partial/login-form-partial.phtml',
            "partials-form-register" => __DIR__ . '/../view/partial/register-form-partial.phtml',

        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => array(
            'ViewJsonStrategy'
        )
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

    // 'driver' => [
    //     'orm_crawler_annotation' => [
    //         'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
    //         'cache' => 'array',
    //         'paths' => [
    //             __DIR__ . '/../src/Crawler/Entity',
    //         ],
    //     ],
    //     'orm_crawler_chain' => [
    //         'class'   => \Doctrine\ORM\Mapping\Driver\DriverChain::class,
    //         'drivers' => [
    //             'Crawler\Entity' =>  'orm_crawler_annotation',
    //         ],
    //     ],
    // ],

    'service_manager' => [
        "factories" => [
            GeneralService::class => GeneralServiceFactory::class,
            FunnelSession::class => FunnelSessionFactory::class,
            UploadService::class => UploadServiceFactory::class,
            MotorService::class => MotorServiceFactory::class,
            TransactionService::class => TransactionServiceFactory::class,
            PaystackService::class => PaystackServiceFactory::class,
            TravelService::class => TravelServiceFactory::class,
            SendInBlueMarketing::class => SendInBlueMarketingFactory::class,
        ],
        "aliases" => [
            "general_service" => GeneralService::class,
            "funnel_session" => FunnelSession::class,
            'upload_service' => UploadService::class,
            'paystack_service' => PaystackService::class,
            "send_in_blue" => SendInBlueMarketing::class,
        ]
    ],

    "input_filters" => [
        "factories" => [
            RegisterInputFilter::class => RegisterInputFilterFactory::class,
            LoginInputFilter::class => InvokableFactory::class,
            TravelInputFIlter::class => InvokableFactory::class,
        ]
    ],
    'view_helpers' => [
        "factories" => [
            InvoiceStatusHelper::class => InvokableFactory::class,
        ],
        "aliases" => [
            "invoicestatus" => InvoiceStatusHelper::class
        ]
    ],


];
