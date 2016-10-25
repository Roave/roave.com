<?php
namespace Roave\Data;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\RouteResult;

class ConfigDataMiddleware
{
    private $config;
    private $topKey = 'site_data';

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $result = $request->getAttribute(RouteResult::class, false);
        $matchedRoute = $result->getMatchedRouteName();
        $data = $this->config[$this->topKey][$matchedRoute];

        $request = $request->withAttribute($this->topKey, json_decode(json_encode($data)));

        return $next($request, $response);
    }
}
