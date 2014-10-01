<?php

class TagCloudWidget extends CWidget
{

    /**
     * @var string
     */
    public $title = 'Tagcloud';


    public function init()
    {
        /* @var CAssetManager $assetManager */
        /* @var CClientScript $clientScript */

        /** @noinspection PhpUndefinedFieldInspection */
        $assetManager = Yii::app()->assetManager;

        /** @noinspection PhpUndefinedFieldInspection */
        $clientScript = Yii::app()->clientScript;

        $cssFile = $assetManager->publish(dirname(__FILE__) . '/css/tag-cloud.css');
        $clientScript->registerCssFile($cssFile);
    }

    public function run()
    {
        /* @var WebUser $webUser */
        /** @noinspection PhpUndefinedFieldInspection */
        $webUser = Yii::app()->user;

        $models = Tag::model()->userId($webUser->id)->findAll();
        $tagCount = EntryHasTag::model()->userId($webUser->id)->count();

        $tags = array();
        foreach ($models as $model) {
            /* @var Tag $model */

            $entryCount = 0;
            foreach ($model->entries as $entry) {
                if ($entry->userId == $webUser->id) {
                    $entryCount++;
                }
            }

            if ($entryCount > 0) {
                $tags[] = array(
                    'name' => $model->name,
                    'weight' => ceil($entryCount / $tagCount * 10)
                );
            }
        }

        $this->render('cloud', array('tags' => $tags));
    }
}
