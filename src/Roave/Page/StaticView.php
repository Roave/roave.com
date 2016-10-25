<?php
namespace Roave\Page;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\Router\RouteResult;
use Zend\Diactoros\Response\HtmlResponse;
use Roave\Data\ConfigDataMiddleware;

class StaticView
{
    public function __construct(TemplateRendererInterface $template = null)
    {
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $result = $request->getAttribute(RouteResult::class, false);
        $matchedRoute = $result->getMatchedRouteName();

        $data = $request->getAttribute('site_data', false) ?: [];

        return new HtmlResponse($this->template->render('page::' . $matchedRoute, $data));
    }
}
