<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/setup.css');

    $this->breadcrumbs = array(
        'Setup'    => array('setup/'),
        'Complete'
    );
?>

<h1>Installation complete</h1>

<p>
    Congratulations!
    Go to <?php echo CHtml::link('login', array('user/login')) ?>.
</p>