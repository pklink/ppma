<?php

namespace ppma\Action\User;

use ppma\Action\AbstractAction;
use ppma\Model\User;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class IndexAction extends AbstractAction
{

    /**
     * @see AbstractAction::__invoke()
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    function __invoke(Request $request, Response $response, array $args) : ResponseInterface
    {
        if (!$this->hasAccessTo($request, 'users.read')) {
            return $response->withStatus(401);
        }

        return $response->withJson(User::with('role')->get());
    }

}
