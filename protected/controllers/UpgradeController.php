<?php

class UpgradeController extends Controller
{

    public $layout = '//layouts/upgrade';

    /**
     * @return boolean
     */
    protected function _is0_2Installed()
    {
        return !is_null(Tag::model()->tableSchema->getColumn('userId'));
    }


    /**
     * @return boolean
     */
    protected function _is0_3_0Installed()
    {
        return Setting::model()->countByAttributes(array('name' => 'registration_enabled')) == 0;
    }


    /**
     * @return boolean
     */
    protected function _is0_3_1Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '310000000';
    }


    /**
     * @return boolean
     */
    protected function _is0_3_2Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '320000000';
    }


    /**
     * @return boolean
     */
    protected function _is0_3_3Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '330000000';
    }


    /**
     * @return boolean
     */
    protected function _is0_3_3_1Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '331000000';
    }


    /**
     * @return boolean
     */
    protected function _is0_3_4Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '340000000';
    }

    /**
     * @return boolean
     */
    protected function _is0_3_4_1Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '341000000';
    }

    /**
     * @return boolean
     */
    protected function _is0_3_5Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '350000000';
    }

    /**
     * @return boolean
     */
    protected function _is0_3_6Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '360000000';
    }


    /**
     * @return boolean
     */
    protected function _is0_3_7Installed()
    {
        $version = str_replace('.', '', Yii::app()->params['version']);
        $version = str_pad($version, 10, 0, STR_PAD_RIGHT);

        return $version >= '370000000';
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_2()
    {
        if ($this->_is0_2Installed()) {
            $this->redirect(array('index', 'version' => '0.3.0', 'do' => 'yes'));
            Yii::app()->end();
        }

        // Add Tag-column
        $cmd = Yii::app()->db->createCommand();
        $cmd->addColumn('Tag', 'userId', 'integer NOT NULL');
        $cmd->addForeignKey('user', 'Tag', 'userId', 'User', 'id', 'CASCADE', 'CASCADE');

        // Refresh DB-Schema
        Yii::app()->db->schema->refresh();
        Tag::model()->refreshMetaData();

        // Set user-IDs
        foreach (Tag::model()->findAll() as $model) {
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

        $this->refresh();
    }

    /**
     * @return void
     */
    protected function _upgradeTo0_3_0()
    {
        if ($this->_is0_3_0Installed()) {
            $this->redirect(array('index', 'version' => '0.3.1', 'do' => 'yes'));
            Yii::app()->end();
        }

        // remove registration-setting
        Setting::model()->deleteAllByAttributes(array('name' => 'registration_enabled'));

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.0';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->refresh();
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_1()
    {
        if ($this->_is0_3_1Installed()) {
            $this->redirect(array('index', 'version' => '0.3.2', 'do' => 'yes'));
            Yii::app()->end();
        }

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.1';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->refresh();
    }

    /**
     * @return void
     */
    protected function _upgradeTo0_3_2()
    {
        if ($this->_is0_3_2Installed()) {
            $this->redirect(array('index', 'version' => '0.3.3', 'do' => 'yes'));
            Yii::app()->end();
        }

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.2';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->refresh();
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_3()
    {
        if ($this->_is0_3_3Installed()) {
            $this->redirect(array('index', 'version' => '0.3.3.1', 'do' => 'yes'));
            Yii::app()->end();
        }

        // add settings for recenent-entries-widget
        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.3';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->refresh();
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_3_1()
    {
        if ($this->_is0_3_3_1Installed()) {
            $this->redirect(array('index', 'version' => '0.3.4', 'do' => 'yes'));
            Yii::app()->end();
        }

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.3.1';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->refresh();
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_4()
    {
        if ($this->_is0_3_4Installed()) {
            $this->redirect(array('index', 'version' => '0.3.4.1', 'do' => 'yes'));
            Yii::app()->end();
        }

        // add view counter
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

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.4';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->refresh();
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_4_1()
    {
        if ($this->_is0_3_4_1Installed()) {
            $this->redirect(array('index', 'version' => '0.3.5', 'do' => 'yes'));
            Yii::app()->end();
        }

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.4.1';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->refresh();
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_5()
    {
        if ($this->_is0_3_5Installed()) {
            $this->redirect(array('index', 'version' => '0.3.6', 'do' => 'yes'));
            Yii::app()->end();
        }

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

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.5';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        Yii::app()->user->setFlash('version', $config['version']);
        $this->redirect(array('/upgrade/success'));
    }

    /**
     * @return void
     */
    protected function _upgradeTo0_3_6()
    {
        if ($this->_is0_3_6Installed()) {
            $this->redirect(array('index', 'version' => '0.3.7', 'do' => 'yes'));
            Yii::app()->end();
        }

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.6';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        Yii::app()->user->setFlash('version', $config['version']);
        $this->redirect(array('/upgrade/success'));
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_7()
    {
        if ($this->_is0_3_7Installed()) {
            Yii::app()->user->setFlash('failure', true);
            $this->redirect(array('index'));
            Yii::app()->end();
        }

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.7';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        Yii::app()->user->setFlash('version', $config['version']);
        $this->redirect(array('/upgrade/success'));
    }


    /**
     * @param string $version
     * @param string $do
     */
    public function actionIndex($version = '0.2', $do = 'no')
    {
        if ($do != 'yes' && !Yii::app()->user->hasFlash('failure')) {
            $this->render('warn');
            Yii::app()->end();
        }

        $version = str_replace('.', '_', $version);

        if (method_exists($this, '_upgradeTo' . $version) && !Yii::app()->user->hasFlash('failure')) {
            $this->{'_upgradeTo' . $version}();
        } else {
            $this->render('ready');
        }
    }


    /**
     * @return void
     */
    public function actionSuccess()
    {
        if (!Yii::app()->user->hasFlash('version')) {
            $this->redirect(array('index'));
        }

        $this->render('success', array('version' => Yii::app()->user->getFlash('version')));
    }

}