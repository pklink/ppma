<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'db' => [
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => 'ppma1',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'logs' => [
            'pathes' => [
                'error' => __DIR__ . '/logs/error.log'
            ]
        ]
    ],
];
