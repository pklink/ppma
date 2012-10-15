<?php $form=$this->beginWidget('ActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->label($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 255)); ?>

    <?php echo CHtml::submitButton('Search', array('class' => 'secondary button radius')) ?>

    <hr />

<?php $this->endWidget(); ?>
