<?php
/* @var ApplicationSettingsForm $model */
/* @var CActiveForm $form */

?>


<h1>General Settings</h1>

<?php if (Yii::app()->user->hasFlash('success')) : ?>
<div class="alert-box success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
    <a href="" class="close">&times;</a>
</div>
<?php endif; ?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'password-form',
    'focus' => array($model, 'name'),
    'htmlOptions' => array('class' => 'custom'),
)); ?>



    <label for="<?php echo CHtml::activeId($model, 'forceSSL') ?>">
        <?php echo $form->checkBox($model, 'forceSSL', array('class' => 'hide')); ?>
        <span class="custom checkbox <?php echo ($model->forceSSL ? 'checked' : '') ?>"></span> Force using SSL
        <?php echo $form->error($model, 'forceSSL'); ?>
    </label>
    <p class="hint">
        Activate this option to force using SSL/HTTPS. Every HTTP-request will be redirected to the same page by using SSL.
    </p>


    <br />
    <?php echo CHtml::submitButton('Save', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>