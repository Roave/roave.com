<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),

            'about' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/about',
                    'defaults' => array(
                        'controller' => 'PhlySimplePage\Controller\Page',
                        'template'   => 'application/static/about',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'team' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route'    => '/team',
                            'defaults' => array(
                                'controller' => 'PhlySimplePage\Controller\Page',
                                'template'   => 'application/static/team',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Meet the Team',
                'route' => 'about/team',
            ),
        ),
    ),
    'service_manager' => array(
         'factories' => array(
             'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
         ),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'            => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'  => __DIR__ . '/../view/application/index/index.phtml',
            'application/static/about' => __DIR__ . '/../view/application/static/about.phtml',
            'application/static/team'  => __DIR__ . '/../view/application/static/team.phtml',
            'error/404'                => __DIR__ . '/../view/error/404.phtml',
            'error/index'              => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'map' => array(
                'css/style.css' => __DIR__ . '/../public/css/style.less',
            ),
        ),
        'filters' => array(
            'css/style.css' => array(
                array(
                    'service' => 'SxBootstrap\Service\BootstrapFilter',
                ),
            ),
        ),
    ),
);
