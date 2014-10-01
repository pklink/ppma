<?php
    /* @var Entry $model */
?>

<h1>Delete Tag '<i><?= $model->name ?></i>'</h1>

<?= CHtml::beginForm() ?>

    <p>Do you really want to delete this entry?</p>

    <a href="<?= CHtml::normalizeUrl(['entry/index']) ?>">
        <?php echo CHtml::button('Cancel', array('class' => 'secondary button radius'))?>
    </a>
    <?php echo CHtml::submitButton('Yep, delete this entry', array('class' => 'alert button radius'))?>

<?= CHtml::endForm();