<?php
use Roave\Page;
use Roave\Data;
use Zend\Expressive\Router;

return [
    'dependencies' => [
        'invokables' => [
            Router\RouterInterface::class => Router\FastRouteRouter::class,
        ],
        'factories' => [
            Page\StaticView::class => Page\StaticViewFactory::class,
            Data\ConfigDataMiddleware::class => Data\ConfigDataMiddlewareFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Page\StaticView::class,
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'team',
            'path' => '/team',
            'middleware' => [Data\ConfigDataMiddleware::class, Page\StaticView::class],
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'talks',
            'path' => '/talks',
            'middleware' => [Data\ConfigDataMiddleware::class, Page\StaticView::class],
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'labs',
            'path' => '/labs',
            'middleware' => Page\StaticView::class,
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'services',
            'path' => '/services',
            'middleware' => Page\StaticView::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
