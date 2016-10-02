<?php

// add error handler
$container['errorHandler'] = function () {
    /** @noinspection PhpUnusedParameterInspection */
    /** @noinspection PhpDocSignatureInspection */
    return function (\Slim\Http\Request $request, \Slim\Http\Response $response, Exception $exception) {
        if ($exception instanceof \ppma\Exception\ForbiddenException) {
            return $response->withStatus(403);
        } else {
            return $response->withStatus(500);
        }
    };
};
