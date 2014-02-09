<?php /* @var LoginForm $model */ ?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'login-form',
    'focus' => array($model, 'username'),
)); ?>

    <?php echo $form->labelEx($model, 'username'); ?>
    <?php echo $form->textField($model, 'username'); ?>
    <?php echo $form->error($model, 'username'); ?>

    <?php echo $form->labelEx($model, 'password'); ?>
    <div class="row collapse">
        <div class="ten columns">
            <?php echo $form->passwordField($model, 'password'); ?>
        </div>
        <div class="two columns">
            <a class="postfix button secondary expand"><i class="foundicon-right-arrow"></i></a>
        </div>
    </div>
    <?php echo $form->error($model, 'password'); ?>

<?php $this->endWidget(); ?>