<?php

// change the following paths if necessary
$yii    = dirname(__FILE__) . '/vendor/yiisoft/yii/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';
// $config=dirname(__FILE__).'/protected/config/test.php'; // for testing

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

/** @noinspection PhpIncludeInspection */
require_once($yii);
Yii::createWebApplication($config)->run();
