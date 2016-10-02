<?php

namespace ppma\Action\Entry;

use ppma\Action\AbstractAction;
use ppma\Exception\ForbiddenException;
use ppma\Model\Entry;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\NotFoundException;
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
     * @throws ForbiddenException
     * @throws NotFoundException
     */
    function __invoke(Request $request, Response $response, array $args) : ResponseInterface
    {
        $this->hasAccessTo('entries.read');
        $model = Entry::find($args['id']);

        // check if model exists
        if ($model == null) {
            throw new NotFoundException($request, $response);
        }

        // check ownership
        if ($model->owner_id != $this->user->id) {
            throw new ForbiddenException();
        }

        return $response->withJson($model);
    }

}
