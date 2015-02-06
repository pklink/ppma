<?php
    /* @var Entry $model */
?>

<h1>Delete Entry '<i><?php echo $model->name ?></i>'</h1>

<?php echo CHtml::beginForm() ?>

    <p>Do you really want to delete this entry?</p>

    <a href="<?php echo CHtml::normalizeUrl(array('entry/index')) ?>">
        <?php echo CHtml::button('Cancel', array('class' => 'secondary button radius'))?>
    </a>
    <?php echo CHtml::submitButton('Yep, delete this entry', array('class' => 'alert button radius'))?>

<?php echo CHtml::endForm();