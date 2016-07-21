<?php

/* @var ImportCsvUploadForm $model */
/* @var int $maxImport */

?>

<h1>Import phpPasswordManager-CSV</h1>

<div class="row">
    <div class="ten columns">
        <div class="panel radius">
            <p><i class="foundicon-idea"></i> You can import up to <?php echo $maxImport ?> entries. Increase the <code>max_input_vars</code> value in your <code>php.ini</code> to import more entries.</p>
        </div>
        <p>Export the <code>accounts</code>-table from your existing <a href="https://sourceforge.net/projects/phppassmanager/" target="_blank">phpPasswordManager</a> installation as CSV file and upload the created file here.</p>
        <p>The file will be read in the following format: <code>intAccountId</code>, <code>vacName</code>, <code>intGroupFid</code>, <code>vacLogin</code>, <code>vacUrl</code>, <code>vacPassword</code>, <code>vacMd5Password</code>, <code>vacInitialValue</code>, <code>txtNotice</code>, <code>intCountView</code>, <code>intCountDecrypt</code>, <code>datAdded</code>, <code>datChanged</code></p>
        <p>Only files with <code>csv</code>-extension are allowed, the delimeter is <code>,</code> and the first line will be ignored.</p>
        <p>Tested with CSV files created by <a href="http://www.sequelpro.com/" target="_blank">Sequel Pro</a> (in version 1.1.2).</p>
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