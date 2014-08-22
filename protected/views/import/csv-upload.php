<?php

/* @var ImportCsvUploadForm $model */

?>

<h1>Import CSV</h1>

<div class="row">
    <div class="ten columns">
        <div class="panel radius">
            <p><i class="foundicon-idea"></i> You can import up to <?php echo $maxImport ?> entries. Increase the <code>max_input_vars</code> value in your <code>php.ini</code> to import more entries.</p>
        </div>

        <p>Select the CSV file you would like to import. In the next step you can choose and correct the imported data before writing them in the database.</p>
        <p>The file will be read in the following format: <code>Name</code>,<code>URL</code>,<code>Comment</code>,<code>Tags</code>,<code>Username</code>,<code>Password</code></p>
        <p>Only files with <code>csv</code>-extension are allowed, the delimeter is <code>,</code> and the first line will be ignored.</p>
    </div>
</div>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'import-upload-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>
    <?php /* @var CActiveForm $form */ ?>

    <?php echo $form->errorSummary($model, '<div class="alert-box alert">', '</div>') ?>

    <?php echo $form->fileField($model, 'file', array('class' => 'hide')); ?>

    <?php echo CHtml::button('Upload File', array('class' => 'button radius', 'id' => 'upload-file'))?>

<?php $this->endWidget(); ?>