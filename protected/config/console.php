<?php

// include ppma-config
$ppma = include dirname(__FILE__) . '/ppma.php';

// This is the configuration for yiic console application.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'     => 'ppma-console',

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
    ),

    'commandMap' => array(
        'migrate' => array(
            'class'          => 'system.cli.commands.MigrateCommand',
            'migrationTable' => 'YiiMigration',
        ),
    ),

    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=' . $ppma['db']['server'] . ';dbname=' . $ppma['db']['name'],
            'username'         => $ppma['db']['username'],
            'password'         => $ppma['db']['password'],
        ),
    ),
);