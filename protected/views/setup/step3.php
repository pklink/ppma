<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/setup.css');

    $this->breadcrumbs = array(
        'Setup'  => array('setup/'),
        'Step 1' => array('setup/', 'step' => 1),
        'Step 2' => array('setup/', 'step' => 2),
        'Step 3: Create Administrator',
    );
?>

<h1>Create Administrator</h1>

<div class="form">
    <?php echo $form ?>
</div>