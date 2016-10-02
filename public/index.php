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

// add error handler
$container['errorHandler'] = function () {
    /** @noinspection PhpUnusedParameterInspection */
    return function (\Slim\Http\Request $request, \Slim\Http\Response $response, Exception $exception) {
        if ($exception instanceof \ppma\Exception\ForbiddenException) {
            return $response->withStatus(403);
        } else {
            return $response->withStatus(500);
        }
    };
};

// add jwt-service
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
});


// run app
$app->run();
