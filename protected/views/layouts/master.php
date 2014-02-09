<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/general_enclosed_foundicons.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/accessibility_foundicons.css">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" />

        <!--[if lt IE 8]>
            <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/general_enclosed_foundicons_ie7.css">
            <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/accessibility_foundicons_ie7.css">
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/foundation.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/app.css">
        <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma.min.js'); ?>
    	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <?php echo $content; ?>

        <?php $this->widget('ext.EModal.EModal', array('outputBuffer' => true)) ?>
    </body>
</html>