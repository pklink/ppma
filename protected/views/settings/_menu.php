<?php

    $this->menu = array(
        array('label' => 'Application',     'url' => array('application'), 'visible' => Yii::app()->user->isAdmin),
        array('label' => 'Change Password', 'url' => array('password')),
    );
    
?>