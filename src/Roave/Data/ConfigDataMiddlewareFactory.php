<?php
namespace Roave\Data;

use Interop\Container\ContainerInterface;

class ConfigDataMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = ($container->has('config'))
            ? $container->get('config')
            : null;

        return new ConfigDataMiddleware($config);
    }
}
