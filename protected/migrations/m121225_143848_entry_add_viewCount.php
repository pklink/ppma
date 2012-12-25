<?php

class m121225_143848_entry_add_viewCount extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('Entry', 'viewCount', 'int NOT NULL DEFAULT 0');

        $model = new Setting();
        $model->name  = Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name  = Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();
	}

	public function safeDown()
	{
        $this->dropColumn('Entry', 'viewCount');
        Setting::model()->deleteAllByAttributes(array('name' => Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT));
        Setting::model()->deleteAllByAttributes(array('name' => Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED));
	}

}