<?php

class TagCloudWidget extends CWidget
{

    /**
     *
     * @var string
     */
    public $title = 'Tagcloud';


    /**
     * (non-PHPdoc)
     * @see yii/CWidget#init()
     */
    public function init()
    {
        $cssFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/css/tag-cloud.css');
        Yii::app()->clientScript->registerCssFile($cssFile);
    }


    /**
     * (non-PHPdoc)
     * @see yii/CWidget#run()
     */
    public function run()
    {
        $models   = Tag::model()->userId( Yii::app()->user->id )->findAll();
        $tagCount = EntryHasTag::model()->userId( Yii::app()->user->id )->count();
        $tags     = array();

        foreach ($models as $model)
        {
            $entryCount = 0;
            foreach ($model->entries as $entry)
            {
                if ($entry->userId == Yii::app()->user->id)
                {
                    $entryCount++;
                }
            }

            if ($entryCount > 0)
            {
                $tags[] = array(
                    'name' => $model->name,
                    'weight' => ceil($entryCount / $tagCount * 10)
                );
            }
        }

        $this->render('cloud', array('tags' => $tags));
    }

}