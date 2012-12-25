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
    </label>
    <p class="hint">
        Activate this option to force using SSL/HTTPS. Every HTTP-request will be redirected to the same page by using SSL.
    </p>


    <hr />


    <label for="<?php echo CHtml::activeId($model, 'recentEntryWidgetEnabled') ?>">
        <?php echo $form->checkBox($model, 'recentEntryWidgetEnabled', array('class' => 'hide')); ?>
        <span class="custom checkbox <?php echo ($model->recentEntryWidgetEnabled ? 'checked' : '') ?>"></span> Show "Recent Entries" widget
    </label>
    <p class="hint">
        Disable this option to hide the "Recent Entries" widget in the sidebar.
    </p>

    <div class="row">
        <div class="seven columns">
            <?php echo $form->labelEx($model, 'recentEntryWidgetCount'); ?>
            <?php echo $form->textField($model, 'recentEntryWidgetCount'); ?>
            <?php echo $form->error($model, 'recentEntryWidgetCount'); ?>
        </div>
    </div>


    <hr />


    <label for="<?php echo CHtml::activeId($model, 'mostViewedEntriesWidgetEnabled') ?>">
        <?php echo $form->checkBox($model, 'mostViewedEntriesWidgetEnabled', array('class' => 'hide')); ?>
        <span class="custom checkbox <?php echo ($model->mostViewedEntriesWidgetEnabled ? 'checked' : '') ?>"></span> Show "Most Viewed" widget
    </label>
    <p class="hint">
        Disable this option to hide the "Most Viewed" widget in the sidebar.
    </p>

    <div class="row">
        <div class="seven columns">
            <?php echo $form->labelEx($model, 'mostViewedEntriesWidgetCount'); ?>
            <?php echo $form->textField($model, 'mostViewedEntriesWidgetCount'); ?>
            <?php echo $form->error($model, 'mostViewedEntriesWidgetCount'); ?>
        </div>
    </div>


    <hr />


    <?php echo CHtml::submitButton('Save', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>