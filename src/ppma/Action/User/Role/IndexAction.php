<?php

namespace ppma\Action\User\Role;

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
        // retrieve model
        $model = User::find($args['id']);

        // model does not exist
        if ($model == null) {
            return $response->withStatus(404);
        }

        return $response->withJson($model->role);
    }

}
