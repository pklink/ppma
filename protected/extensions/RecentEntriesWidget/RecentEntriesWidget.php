<?php

class RecentEntriesWidget extends CWidget
{

    /**
     * @var string
     */
    public $title = 'Recent Entries';

    public function run()
    {
        // criteria for last entries
        $c = new CDbCriteria();
        $c->order = 't.id DESC';
        /** @noinspection PhpUndefinedMethodInspection */
        $c->limit = Setting::model()->name(Setting::RECENT_ENTRIES_WIDGET_COUNT)->find()->value;

        // get entries
        $models = Entry::model()->findAll($c);

        // render view
        $this->render('recent', array('models' => $models));
    }
}
