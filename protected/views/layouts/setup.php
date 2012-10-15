<?php $this->beginContent('application.views.layouts.master'); ?>

    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'    => false,
        'links'       => $this->breadcrumbs,
        'htmlOptions' => array(
            'class' => 'breadcrumbs setup',
        )
    )); ?>

    <div id="container">
        <div id="content">
            <?php echo $content; ?>
        </div>
    </div>

<?php $this->endContent(); ?>