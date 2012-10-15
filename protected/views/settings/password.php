<?php
    $this->breadcrumbs = array(
        'Settings' => array('index'),
        'Change Password',
    );

    $this->renderPartial('_menu');
?>

<h1>Change Password</h1>

<?php if (Yii::app()->user->hasFlash('success')) : ?>
    <div class="flash-success">Password changed!</div>

<?php else : ?>
    <div class="form">
        <?php echo $form; ?>
    </div>

<?php endif; ?>