<?php

namespace ppma;

use Psr\Http\Message\ResponseInterface;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

interface Action
{

    /**
     * Action constructor.
     * @param Container $container
     */
    public function __construct(Container $container);

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, array $args) : ResponseInterface;

}