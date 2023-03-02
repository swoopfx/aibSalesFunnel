<?php

declare(strict_types=1);

namespace Application;

use Application\Controller\AuthController;
use Application\Controller\Factory\AuthControllerFactory;
use Application\Controller\Factory\IndexControllerFactory;
use Application\Form\Factory\RegisterInputFilterFactory;
use Application\Form\LoginInputFilter;
use Application\Form\RegisterInputFilter;
use Application\Service\Factory\FunnelSessionFactory;
use Application\Service\Factory\GeneralServiceFactory;
use Application\Service\Factory\MotorServiceFactory;
use Application\Service\Factory\TransactionServiceFactory;
use Application\Service\Factory\UploadServiceFactory;
use Application\Service\FunnelSession;
use Application\Service\GeneralService;
use Application\Service\MotorService;
use Application\Service\TransactionService;
use Application\Service\UploadService;
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
                        'id' => '[a-zA-Z0-9]*'
                    ),
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class,
            AuthController::class => AuthControllerFactory::class
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
            UploadService::class=> UploadServiceFactory::class,
            MotorService::class => MotorServiceFactory::class,
            TransactionService::class => TransactionServiceFactory::class,
        ],
        "aliases" => [
            "general_service" => GeneralService::class,
            "funnel_session" => FunnelSession::class,
            'upload_service'=>UploadService::class,
        ]
    ],

    "input_filters" => [
        "factories" => [
            RegisterInputFilter::class => RegisterInputFilterFactory::class,
            LoginInputFilter::class => InvokableFactory::class
        ]
    ]


];
