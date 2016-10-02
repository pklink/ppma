<?php

namespace ppma\Action\Role;

use ppma\Action\AbstractAction;
use ppma\Model\Role;
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
        if (!$this->hasAccessTo('roles.read')) {
            return $response->withStatus(401);
        }

        // retrieve model
        $model = Role::find($args['id']);

        // model does not exist
        if ($model == null) {
            return $response->withStatus(404);
        }

        return $response->withJson($model);
    }

}
