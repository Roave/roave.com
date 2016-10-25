<?php
use Roave\Page;
use Zend\Expressive\Router;

return [
    'dependencies' => [
        'invokables' => [
            Router\RouterInterface::class => Router\FastRouteRouter::class,
        ],
        'factories' => [
            Page\Home::class  => Page\HomeFactory::class,
            Page\Team::class  => Page\TeamFactory::class,
            Page\Talks::class => Page\TalksFactory::class,
            Page\Labs::class  => Page\LabsFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Page\Home::class,
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'team',
            'path' => '/team',
            'middleware' => Page\Team::class,
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'talks',
            'path' => '/talks',
            'middleware' => Page\Talks::class,
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'labs',
            'path' => '/labs',
            'middleware' => Page\Labs::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
