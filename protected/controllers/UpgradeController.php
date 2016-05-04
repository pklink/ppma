<?php

class UpgradeController extends Controller
{

    public $layout = '//layouts/upgrade';

    private $latestVersion = '0.5.2';

    private $history = array(
        array('0', 'upgradeTo02'),
        array('0.2', 'upgradeTo030'),
        array('0.3.0'),
        array('0.3.1'),
        array('0.3.2', 'upgradeTo033'),
        array('0.3.3'),
        array('0.3.3.1', 'upgradeTo034'),
        array('0.3.4'),
        array('0.3.4.1', 'upgradeTo035'),
        array('0.3.5'),
        array('0.3.6'),
        array('0.3.7'),
        array('0.3.8'),
        array('0.3.9'),
        array('0.3.10', 'upgradeTo040'),
        array('0.4.0'),
        array('0.4.1'),
        array('0.4.2'),
        array('0.5.0'),
        array('0.5.1'),
    );

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionRun()
    {
        // get routines to upgrade
        $installedVersion = Yii::app()->params['version'];
        $addRoutines = false;
        $routines = array();
        foreach ($this->history as $version) {
            if (!$addRoutines && $version[0] == $installedVersion) {
                $addRoutines = true;
            }

            if ($addRoutines && isset($version[1])) {
                $routines[] = $version[1];
            }
        }

        // run upgrade routines
        foreach ($routines as $routine) {
            $this->{$routine}();
        }

        // upgrade complete
        if ($addRoutines) {
            // write latest version to config
            $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
            /** @noinspection PhpIncludeInspection */
            $config = new CConfiguration(require($path));
            $config['version'] = $this->latestVersion;
            file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

            $this->render('success', array('version' => $this->latestVersion));
        } else {
            $this->render('isuptodate');
        }
    }

    /**
     * @return void
     */
    protected function upgradeTo02()
    {
        // Add Tag-column
        /* @var CDbCommand $cmd */
        $cmd = Yii::app()->db->createCommand();
        $cmd->addColumn('Tag', 'userId', 'integer NOT NULL');
        $cmd->addForeignKey('user', 'Tag', 'userId', 'User', 'id', 'CASCADE', 'CASCADE');

        // Refresh DB-Schema
        Yii::app()->db->schema->refresh();
        Tag::model()->refreshMetaData();

        // Set user-IDs
        foreach (Tag::model()->findAll() as $model) {
            /* @var Tag $model */
            // Collect User-IDs
            $userIds = array();
            foreach ($model->entries as $entry) {
                $userIds[$entry->userId] = $entry->userId;
            }

            // Save tag with user relation
            foreach ($userIds as $userId) {
                $tag = new Tag();
                $tag->name = $model->name;
                $tag->userId = $userId;
                $tag->save(false);
            }

            // Remove tag
            $model->delete();
        }
    }

    /**
     * @return void
     */
    protected function upgradeTo030()
    {
        // remove registration-setting
        Setting::model()->deleteAllByAttributes(array('name' => 'registration_enabled'));
    }

    /**
     * @return void
     */
    protected function upgradeTo033()
    {
        // add settings for recenent-entries-widget
        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();
    }

    /**
     * @return void
     */
    protected function upgradeTo034()
    {
        // add view counter
        /* @var CDbCommand $cmd */
        $cmd = Yii::app()->db->createCommand();
        $cmd->addColumn('Entry', 'viewCount', 'int NOT NULL DEFAULT 0');

        // add settings for "Most Viewed" widget
        $model = new Setting();
        $model->name = Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name = Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();
    }

    /**
     * @return void
     */
    protected function upgradeTo035()
    {
        // create new settings
        $model = new Setting();
        $model->name = Setting::TAG_CLOUD_WIDGET_POSITION;
        $model->value = 0;
        $model->save(false);

        $model = new Setting();
        $model->name = Setting::MOST_VIEWED_ENTRIES_WIDGET_POSITION;
        $model->value = 1;
        $model->save(false);

        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_POSITION;
        $model->value = 2;
        $model->save(false);
    }

    /**
     * @return void
     */
    protected function upgradeTo040()
    {
        // add settings for "Most Viewed" widget
        $model = new Setting();
        $model->name = Setting::PAGINATION_PAGE_SIZE_ENTRIES;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name = Setting::PAGINATION_PAGE_SIZE_TAGS;
        $model->value = 10;
        $model->save();
    }
}
