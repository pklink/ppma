<?php

namespace ppma\Action\Setting;

use ppma\Action\AbstractAction;
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
        $table = $this->db->table('Setting')->select('name', 'value');
        return $response->withJson($table->get());
    }

}
