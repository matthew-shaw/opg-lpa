<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class HomeHandler
 * @package App\Handler
 */
class HomeHandler extends AbstractHandler
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $data = [];

        //  TODO... If there is no session then go to sign in.....rbac handling this??

        return new HtmlResponse($this->getTemplateRenderer()->render('app::home', $data));
    }
}
