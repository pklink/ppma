<?php $this->beginContent('application.views.layouts.main'); ?>

    <nav class="top-bar">
        <ul>
            <li class="name"><h1><a href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a></h1></li>
            <li class="toggle-topbar"><a href="#"></a></li>
        </ul>
        <section>
            <ul class="left">
                <li class="has-dropdown">
                    <?php echo CHtml::link('Entries', array('entry/index')) ?>
                    <ul class="dropdown">
                        <li><?php echo CHtml::link('Overview', array('entry/index')) ?></li>
                        <li><?php echo CHtml::link('Create', array('entry/create')) ?></li>
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
                    <a href="#">Profile</a>
                    <ul class="dropdown">
                        <li><?php echo CHtml::link('Logout', array('/user/logout')) ?></li>
                    </ul>
                </li>
            </ul>

            <ul class="right">

                <li class="search">
                    <form action="<?php echo CHtml::normalizeUrl(array('entry/index')) ?>" method="get">
                        <input type="search" name="q" />
                    </form>
                </li>
            </ul>
        </section>
    </nav>

    <div class="row">
        <div class="nine columns" role="content" id="content">
            <?php echo $content; ?>
        </div>


        <aside class="three columns">

            <?php if (!Yii::app()->user->isGuest) : ?>
                <?php $this->widget('ext.TagCloudWidget.TagCloudWidget') ?>
            <?php endif; ?>

        </aside>
    </div>

    <footer class="row">
        <div class="twelve columns">
            * <a href="http://sourceforge.net/projects/ppma/">ppma</a> (version <?php echo Yii::app()->params['version'] ?>)
            powered by <a href="http://www.yiiframework.com/" target="_blank">yii framework</a> (version <?php echo Yii::getVersion() ?>)
        </div>
    </footer>

<?php $this->endContent(); ?>