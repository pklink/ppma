<?php
/* @var PasswordForm $model */
/* @var CActiveForm $form */

?>

<h1>Change Password</h1>

<?php if (Yii::app()->user->hasFlash('success')) : ?>
    <div class="alert-box success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
        <a href="" class="close">&times;</a>
    </div>
<?php endif; ?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'password-form',
    'focus' => array($model, 'name'),
)); ?>

    <?php echo $form->labelEx($model, 'oldPassword'); ?>
    <?php echo $form->passwordField($model, 'oldPassword'); ?>
    <?php echo $form->error($model, 'oldPassword'); ?>

    <?php echo $form->labelEx($model, 'newPassword'); ?>
    <?php echo $form->passwordField($model, 'newPassword'); ?>
    <?php echo $form->error($model, 'newPassword'); ?>

    <?php echo $form->labelEx($model, 'newPasswordRepeat'); ?>
    <?php echo $form->passwordField($model, 'newPasswordRepeat'); ?>
    <?php echo $form->error($model, 'newPasswordRepeat'); ?>

<?php echo CHtml::submitButton('Save', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>