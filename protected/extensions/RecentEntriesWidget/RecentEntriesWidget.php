<?php

class RecentEntriesWidget extends CWidget
{

    /**
     *
     * @var string
     */
    public $title = 'Recent Entries';


    /**
     * (non-PHPdoc)
     * @see yii/CWidget#run()
     */
    public function run()
    {
        // criteria for last entries
        $c = new CDbCriteria();
        $c->order = 't.id DESC';
        $c->limit = 10;

        // get entries
        $models = Entry::model()->findAll($c);

        // render view
        $this->render('recent', array('models' => $models));
    }

}