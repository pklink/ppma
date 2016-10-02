<?php

$container['logger'] = function ($container) {
    // create logger
    $logger = new \Monolog\Logger('ppma');

    // create handler
    $path        = $container['settings']['logs']['pathes']['error'];
    $fileHandler = new \Monolog\Handler\StreamHandler($path, \Monolog\Logger::DEBUG);

    // add handler to logger
    $logger->pushHandler($fileHandler);

    return $logger;
};
