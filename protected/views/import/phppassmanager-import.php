<?php

/* @var ImportPhpPassManagerForm[] $models */

?>

<h1>Import phpPasswordManager-CSV</h1>

<div class="row">
    <div class="ten columns">
        <p>You see the parsed content from the uploaded file below. Please review the data, set the master password for every entry and submit the form.</p>
    </div>
</div>

<?php if (Yii::app()->user->hasFlash('hasError')) : ?>
    <div class="alert-box alert">
        Data was not imported, because of one or more errors. See the red fields below.
    </div>
<?php endif; ?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'import-form',
)); ?>

    <?php /* @var CActiveForm $form */ ?>

    <div class="row ">
        <div class="two columns">
            <strong>Name</strong>
        </div>
        <div class="two columns">
            <strong>Username</strong>
        </div>
        <div class="two columns">
            <strong>URL</strong>
        </div>
        <div class="two columns">
            <strong>Comment</strong>
        </div>
        <div class="four columns">
            <strong>Master Password</strong>
        </div>
    </div><br />

    <?php foreach ($models as $index => $model) : ?>
        <div class="row">
            <div class="two columns">
                <?php echo $form->textField($model, sprintf('[%d]name', $index)); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, sprintf('[%d]username', $index)); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, sprintf('[%d]url', $index)); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textArea($model, sprintf('[%d]comment', $index), array('rows' => 1)); ?>
            </div>
            <div class="three columns">
                <?php echo $form->passwordField($model, sprintf('[%d]masterPassword', $index)); ?>
            </div>
            <div class="one columns import-button-column">
                <?php echo $form->hiddenField($model, sprintf('[%d]password', $index)); ?>
                <?php echo $form->hiddenField($model, sprintf('[%d]hash', $index)); ?>
                <?php echo $form->hiddenField($model, sprintf('[%d]iv', $index)); ?>
                <i class="large foundicon-remove"></i>
            </div>
        </div>
    <?php endforeach; ?>

    <?php echo CHtml::submitButton('Import', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>