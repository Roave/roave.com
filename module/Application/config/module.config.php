<?php
/**
 * Zend Framework (http://framework.zend.com/]
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c] 2005-2013 Zend Technologies USA Inc. (http://www.zend.com]
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'PhlySimplePage\Controller\Page',
                        'template'   => 'application/static/index',
                    ],
                ],
            ],
            'team' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/team',
                    'defaults' => [
                        'controller' => 'PhlySimplePage\Controller\Page',
                        'template'   => 'application/static/team',
                    ],
                ],
            ],
            'clients' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/clients',
                    'defaults' => [
                        'controller' => 'PhlySimplePage\Controller\Page',
                        'template'   => 'application/static/clients',
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'home',
            ],
            [
                'label' => 'Meet the Team',
                'route' => 'team',
            ],
            [
                'label' => 'Clients',
                'route' => 'clients',
            ],
        ],
    ],
    'service_manager' => [
         'factories' => [
             'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
         ],
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
    ],
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'            => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'  => __DIR__ . '/../view/application/index/index.phtml',
            'application/static/about' => __DIR__ . '/../view/application/static/about.phtml',
            'application/static/team'  => __DIR__ . '/../view/application/static/team.phtml',
            'error/404'                => __DIR__ . '/../view/error/404.phtml',
            'error/index'              => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'map' => [
                'css/style.css' => __DIR__ . '/../public/css/style.less',
            ],
        ],
        'filters' => [
            'css/style.css' => [
                [
                    'service' => 'SxBootstrap\Service\BootstrapFilter',
                ],
            ],
        ],
    ],
];
