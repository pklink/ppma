<aside class="three columns" rel="<?php echo CHtml::normalizeUrl(array('settings/setSidebarPositions'))?>">

    <?php $models = Setting::model()->sidebar()->findAll(); ?>

    <?php if (count($models) > 0) : ?>

        <?php foreach ($models as $model) : ?>
            <?php /* @var Setting $model */ ?>

            <?php if ($model->name == Setting::TAG_CLOUD_WIDGET_POSITION) : ?>
                <?php $this->widget('ext.TagCloudWidget.TagCloudWidget') ?>

            <?php elseif ($model->name == Setting::MOST_VIEWED_ENTRIES_WIDGET_POSITION) : ?>
                <?php if (Yii::app()->settings->getAsBool(Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED)) : ?>
                    <?php $this->widget('ext.MostViewedEntriesWidget.MostViewedEntriesWidget') ?>
                <?php endif; ?>

            <?php elseif ($model->name == Setting::RECENT_ENTRIES_WIDGET_POSITION) : ?>
                <?php if (Yii::app()->settings->getAsBool(Setting::RECENT_ENTRIES_WIDGET_ENABLED)) : ?>
                    <?php $this->widget('ext.RecentEntriesWidget.RecentEntriesWidget') ?>
                <?php endif; ?>

            <?php endif; ?>

        <?php endforeach; ?>

    <?php else : ?>

        <?php $this->widget('ext.TagCloudWidget.TagCloudWidget') ?>

        <?php if (Yii::app()->settings->getAsBool(Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED)) : ?>
            <?php $this->widget('ext.MostViewedEntriesWidget.MostViewedEntriesWidget') ?>
        <?php endif; ?>

        <?php if (Yii::app()->settings->getAsBool(Setting::RECENT_ENTRIES_WIDGET_ENABLED)) : ?>
            <?php $this->widget('ext.RecentEntriesWidget.RecentEntriesWidget') ?>
        <?php endif; ?>

    <?php endif; ?>

</aside>