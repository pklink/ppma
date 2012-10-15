<?php
    $this->breadcrumbs = array(
        'Settings' => array('index'),
        'Application',
    );

    $this->renderPartial('_menu');
?>

<h1>Registration</h1>

<?php if (Yii::app()->user->hasFlash('success')) : ?>
    <div class="flash-success">Settings saved!</div>
<?php endif; ?>

<div class="form">
    <?php echo $form; ?>
</div>
