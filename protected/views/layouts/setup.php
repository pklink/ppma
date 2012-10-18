<?php $this->beginContent('application.views.layouts.master'); ?>

    <ul class="breadcrumbs">
        <li><?php echo CHtml::link('Setup', array('index')) ?></li>
        <li class="current"><span>Step <?php echo Yii::app()->request->getQuery('step', 1) ?></span></li>
    </ul>


    <div class="row">
        <div class="twelve columns" id="content">
            <?php echo $content; ?>
        </div>
    </div>

<?php $this->endContent(); ?>