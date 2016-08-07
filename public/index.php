<?php


require __DIR__ . '/../vendor/autoload.php';

// load confing
$config = require __DIR__ . '/../config.php';

// create app
$app = new \Slim\App($config);

// get di-container
$container = $app->getContainer();

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};


// register routes
$app->get('/entries', \ppma\Action\Entry\IndexAction::class);
$app->get('/settings', \ppma\Action\Setting\IndexAction::class);

// run app
$app->run();
