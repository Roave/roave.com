<?php
namespace Roave\Page;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;

class Team
{
    private $team = [
        [
            'name'     => 'Evan Coury (EvanDotPro)',
            'gravatar' => '3fb997938a45ac4ea89a90164931368d',
            'bio'      => "Evan is a Zend certified engineer for PHP 5.3 and Zend Framework, as well as a regular speaker at developer conferences around the world. He's worked on and led many large-scale web development projects to success. When not in front of a computer, Evan enjoys being outdoors with his two border collies and doing anything related to aviation.",
        ],

    ];

    public function __construct(TemplateRendererInterface $template = null)
    {
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        return new HtmlResponse($this->template->render('page::team', ['team' => json_decode(json_encode($this->team))]));
    }
}
