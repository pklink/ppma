    <?php $form=$this->beginWidget('ActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

            <?php echo $form->label($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 255)); ?>

            <?php echo $form->label($model, 'url'); ?>
            <?php echo $form->textField($model, 'url', array('size' => 50, 'maxlength' => 255)); ?>

            <?php echo $form->label($model, 'username'); ?>
            <?php echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 255)); ?>

            <?php echo $form->label($model, 'tagList'); ?>
            <?php echo $form->textField($model, 'tagList', array('size' => 50)); ?>

            <?php echo $form->label($model, 'comment'); ?>
            <?php echo $form->textField($model, 'comment', array('size' => 50)); ?>

            <?php echo CHtml::submitButton('Search', array('class' => 'secondary button radius')) ?>

            <hr />

    <?php $this->endWidget(); ?>
