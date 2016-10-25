<?php
use Zend\Expressive\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$container = require 'config/container.php';

$app = $container->get(Application::class);
$app->pipeRoutingMiddleware();
$app->pipeDispatchMiddleware();
$app->run();
