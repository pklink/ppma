<?php

// logins
$app->post('/login', \ppma\Action\Login\IndexAction::class);

// entries
$app->group('/entries', function () use ($app)  {
    $app->get('', \ppma\Action\Entry\IndexAction::class);
    $app->get('/{id}', \ppma\Action\Entry\GetAction::class);
});

// roles
$app->group('/roles', function () use ($app)  {
    $app->get('/{id}', \ppma\Action\User\GetAction::class);
});

// users
$app->group('/users', function () use ($app)  {
    $app->get('', \ppma\Action\User\IndexAction::class);
    $app->post('', \ppma\Action\User\CreateAction::class);
    $app->get('/{id}', \ppma\Action\User\GetAction::class);
});
