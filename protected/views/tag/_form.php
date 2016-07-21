<?php
/* @var Tag $model */
/* @var CActiveForm $form */

?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'entry-form',
    'focus' => array($model, 'name'),
)); ?>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>


    <?php echo CHtml::hiddenField('returnUrl', Yii::app()->request->getQuery('returnUrl', CHtml::normalizeUrl(array('index')))); ?>
    <?php echo CHtml::submitButton('Save', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>