<?php

// include ppma-config
$ppma = include dirname(__FILE__) . '/ppma.php';

// set default port if is needed
if (!isset($ppma['db']['port'])) {
    $ppma['db']['port'] = 3306;
}

// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'     => 'PHP Password Manager',

    // preloading 'log' component
	'preload' => array('log'),

    // autoloading model and component classes
	'import' => array(
        'application.models.*',
        'application.models.forms.*',
        'application.components.*',
        'zii.widgets.grid.CGridView'
    ),

    // modules
    'modules' => array(
        'gii' => array(
            'class'          => 'system.gii.GiiModule',
            'password'       => 'password',
            'ipFilters'      => array('192.168.*.*'),
            'generatorPaths' => array(
                'ext.gtc',
            ),
        ),
    ),
    
    // application components
    'components' => array(
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js'     => 'js/foundation.min.js',
                'jquery.min.js' => 'js/foundation.min.js',
            ),
        ),

        'db' => array(
            'connectionString' => sprintf('mysql:host=%s;port=%d;dbname=%s;', $ppma['db']['server'], $ppma['db']['port'], $ppma['db']['name']),
            'username'         => $ppma['db']['username'],
            'password'         => $ppma['db']['password'],
        ),

        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),

        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),

        'phpPassManagerDecryptor' => array(
            'class' => 'PhpPassManagerDecryptorComponent'
        ),

        'securityManager' => array(
            'class' => 'SecurityManager',
        ),
        
        'settings' => array(
            'class' => 'SettingsComponent',
        ),

        'user' => array(
            'class'          => 'WebUser',
            'loginUrl'       => array('/user/login'),
            'allowAutoLogin' => true,
        ),
    ),

    // application parameters
    'params' => array(
        'adminEmail'  => 'webmaster@example.com',
        'isInstalled' => $ppma['isInstalled'],
        'version'     => $ppma['version']
    ),
);