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

// add add monolog service
$container['logger'] = function($container) {
    // create logger
    $logger = new \Monolog\Logger('ppma');

    // create handler
    $path        = $container['settings']['logs']['pathes']['error'];
    $fileHandler = new \Monolog\Handler\StreamHandler($path, \Monolog\Logger::DEBUG);

    // add handler to logger
    $logger->pushHandler($fileHandler);

    return $logger;
};

// add jwt-service
$app->add(new \Slim\Middleware\JwtAuthentication([
    'secret'      => $container['settings']['secret'],
    'path'        => '/',
    'passthrough' => ['/login'],
    'logger'      => $container['logger']
]));

// register routes
$app->post('/login', \ppma\Action\Login\IndexAction::class);
$app->group('/entries', function () use ($app)  {
    $app->get('', \ppma\Action\Entry\IndexAction::class);
});
$app->group('/roles', function () use ($app)  {
    $app->get('/{id}', \ppma\Action\User\GetAction::class);
});
$app->group('/users', function () use ($app)  {
    $app->get('', \ppma\Action\User\IndexAction::class);
    $app->post('', \ppma\Action\User\CreateAction::class);
    $app->get('/{id}', \ppma\Action\User\GetAction::class);
    $app->get('/{id}/role', \ppma\Action\User\Role\IndexAction::class);
});


// run app
$app->run();
