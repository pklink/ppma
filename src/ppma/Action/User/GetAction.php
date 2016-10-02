<?php

namespace ppma\Action\User;

use ppma\Action\AbstractAction;
use ppma\Model\User;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class GetAction extends AbstractAction
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
        $this->hasAccessTo('users.read');

        // retrieve model
        $model = User::with('role')->find($args['id']);

        // model does not exist
        if ($model == null) {
            return $response->withStatus(404);
        }

        return $response->withJson($model);
    }

}
