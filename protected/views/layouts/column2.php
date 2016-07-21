<?php $this->beginContent('application.views.layouts.main'); ?>

    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/custom-theme/jquery-ui-1.9.2.custom.min.css') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui-1.9.2.custom.min.js') ?>

    <nav class="top-bar">
        <ul>
            <li class="name"><h1><a href="<?php echo CHtml::normalizeUrl(array('/')) ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a></h1></li>
        </ul>
        <section>
            <ul class="left">
                <li class="has-dropdown">
                    <?php echo CHtml::link('Entries', array('entry/index')) ?>
                    <ul class="dropdown">
                        <li><?php echo CHtml::link('Overview', array('entry/index')) ?></li>
                        <li><?php echo CHtml::link('Create', array('entry/create')) ?></li>
                        <li class="divider"></li>
                        <li><?php echo CHtml::link('Import from CSV', array('import/csv')) ?></li>
                        <li><?php echo CHtml::link('Import from phpPasswordManager', array('import/phppassmanager')) ?></li>
                        <li class="divider"></li>
                        <li><?php echo CHtml::link('Export to CSV', array('export/csv')) ?></li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    <?php echo CHtml::link('Tags', array('tag/index')) ?>
                    <ul class="dropdown">
                        <li><?php echo CHtml::link('Overview', array('tag/index')) ?></li>
                        <li><?php echo CHtml::link('Create', array('tag/create')) ?></li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    <a>Settings</a>
                    <ul class="dropdown">
                        <li><?php echo CHtml::link('General', array('settings/application')) ?></li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    <a>Profile</a>
                    <ul class="dropdown">
                        <li><?php echo CHtml::link('Change Password', array('settings/password')) ?></li>
                        <li><?php echo CHtml::link('Logout', array('/user/logout')) ?></li>
                    </ul>
                </li>
            </ul>

            <ul class="right">

                <li class="search">
                    <form method="get">
                        <input type="hidden" name="r" value="entry/index" />
                        <input type="search" name="q" value="<?php echo Yii::app()->request->getParam('q') ?>" rel="<?php echo Yii::app()->createAbsoluteUrl('entry/searchName') ?>" />
                    </form>
                </li>
            </ul>
        </section>
    </nav>

    <div class="row">
        <div class="nine columns" role="content" id="content">
            <?php /* @var string $content */ ?>
            <?php echo $content; ?>
        </div>

        <?php $this->renderPartial('//layouts/_sidebar'); ?>

    </div>

    <footer class="row">
        <div class="twelve columns">
            * <a href="http://sourceforge.net/projects/ppma/">ppma</a> (version <?php echo Yii::app()->params['version'] ?>)
            powered by <a href="http://www.yiiframework.com/" target="_blank">yii framework</a> (version <?php echo Yii::getVersion() ?>) and
            <a href="http://foundation.zurb.com/" target="_blank">Foundation 3</a> (version 3.2)
        </div>
    </footer>

    <?php $this->beginWidget('ext.EModal.EModal', array('id' => 'entry-form-modal')); ?>
        <h2>Update entry</h2>
        <?php $this->renderPartial('/entry/_form', array('model' => new Entry())); ?>
    <?php $this->endWidget(); ?>

<?php $this->endContent(); ?>