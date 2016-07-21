<?php

/* @var ImportCsvForm $model */

?>

<h1>Import CSV</h1>

<div class="row">
    <div class="ten columns">
        <p>You see the parsed content from the uploaded file below. Please review the data and submit the form if everthing is fine.</p>
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
            <strong>Password</strong>
        </div>
        <div class="two columns">
            <strong>URL</strong>
        </div>
        <div class="one columns">
            <strong>Tags</strong>
        </div>
        <div class="three columns">
            <strong>Comment</strong>
        </div>
    </div><br />

    <?php /* @var ImportCsvForm[] $models */ ?>
    <?php foreach ($models as $index => $model) : ?>
        <div class="row">
            <div class="two columns">
                <?php echo $form->textField($model, sprintf('[%d]name', $index)); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, sprintf('[%d]username', $index)); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, sprintf('[%d]password', $index)); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textField($model, sprintf('[%d]url', $index)); ?>
            </div>
            <div class="one columns">
                <?php echo $form->textField($model, sprintf('[%d]tags', $index)); ?>
            </div>
            <div class="two columns">
                <?php echo $form->textArea($model, sprintf('[%d]comment', $index), array('rows' => 1)); ?>
            </div>
            <div class="one columns import-button-column">
                <i class="foundicon-remove"></i>
            </div>
        </div>
    <?php endforeach; ?>

    <?php echo CHtml::submitButton('Import', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>