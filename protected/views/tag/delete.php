<?php
    /* @var Tag $model */
?>

<h1>Delete Tag '<i><?php echo $model->name ?></i>'</h1>

<?php echo CHtml::beginForm() ?>

    <p>Do you really want to delete this tag?</p>

    <a href="<?php echo CHtml::normalizeUrl(array('tag/index')) ?>">
        <?php echo CHtml::button('Cancel', array('class' => 'secondary button radius'))?>
    </a>
    <?php echo CHtml::submitButton('Yep, delete this tag', array('class' => 'alert button radius'))?>

<?php echo CHtml::endForm();