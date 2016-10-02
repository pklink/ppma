<?php

require __DIR__ . '/../vendor/autoload.php';

// load confing
$config = require __DIR__ . '/../config.php';

// create app
$app = new \Slim\App($config);

// get di-container
$container = $app->getContainer();

// load services
require __DIR__ . '/../boot/services/db.php';
require __DIR__ . '/../boot/services/error_handler.php';
require __DIR__ . '/../boot/services/logger.php';

// load middlewares
require __DIR__ . '/../boot/middlewares/jwt.php';

// load routes
require __DIR__ . '/../boot/routes.php';

// run app
$app->run();
