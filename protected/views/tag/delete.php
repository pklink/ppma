<?php
    /* @var Tag $model */
?>

<h1>Delete Tag '<i><?= $model->name ?></i>'</h1>

<?= CHtml::beginForm() ?>

    <p>Do you really want to delete this tag?</p>

    <a href="<?= CHtml::normalizeUrl(['tag/index']) ?>">
        <?php echo CHtml::button('Cancel', array('class' => 'secondary button radius'))?>
    </a>
    <?php echo CHtml::submitButton('Yep, delete this tag', array('class' => 'alert button radius'))?>

<?= CHtml::endForm();