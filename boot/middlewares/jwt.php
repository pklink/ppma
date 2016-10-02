<?php

/* @var \Slim\Container $container */

/** @noinspection PhpUnusedParameterInspection */
$app->add(new \Slim\Middleware\JwtAuthentication([
    'secret'      => $container['settings']['secret'],
    'path'        => '/',
    'passthrough' => ['/login'],
    'logger'      => $container['logger'],
    'callback'    => function ($request, $response, $arguments) use ($container) {
        // save decoded token for later use
        $container['jwt'] = $arguments['decoded'];
    }
]));
