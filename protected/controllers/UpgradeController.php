<?php

class UpgradeController extends Controller
{

    public $layout = '//layouts/upgrade';

    /**
     * @return boolean
     */
    protected function _is0_2Installed()
    {
        return !is_null( Tag::model()->tableSchema->getColumn('userId') );
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
     * @return void
     */
    protected function _upgradeTo0_2()
    {
        if ($this->_is0_2Installed())
        {
            $this->redirect(array('index', 'version' => '0.3.0'));
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
        foreach (Tag::model()->findAll() as $model)
        {
            // Collect User-IDs
            $userIds = array();
            foreach ($model->entries as $entry)
            {
                $userIds[$entry->userId] = $entry->userId;
            }
            
            // Save tag with user relation
            foreach ($userIds as $userId)
            {
                $tag = new Tag();
                $tag->name = $model->name;
                $tag->userId = $userId;
                $tag->save(false);
            }
            
            // Remove tag
            $model->delete();
        }
        
        $this->redirect(array('index', 'version' => '0.3.0'));
    }

    /**
     * @return void
     */
    protected function _upgradeTo0_3_0()
    {
        if ($this->_is0_3_0Installed())
        {
            $this->redirect(array('index', 'version' => '0.3.1'));
            Yii::app()->end();
        }

        // remove registration-setting
        Setting::model()->deleteAllByAttributes(array('name' => 'registration_enabled'));

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.0';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->redirect(array('index', 'version' => '0.3.1'));
    }


    /**
     * @return void
     */
    protected function _upgradeTo0_3_1()
    {
        if ($this->_is0_3_1Installed())
        {
            Yii::app()->user->setFlash('failure', true);
            $this->redirect(array('index'));
            Yii::app()->end();
        }

        // update config
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = new CConfiguration(require($path));
        $config['version'] = '0.3.1';
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        Yii::app()->user->setFlash('version', '0.3.1');
        $this->redirect(array('/upgrade/success'));
    }


    /**
     * @param string $version
     */
    public function actionIndex($version = '0.2')
    {
        $version = str_replace('.', '_', $version);

        if (method_exists($this, '_upgradeTo' . $version) && !Yii::app()->user->hasFlash('failure'))
        {
            $this->{'_upgradeTo' . $version}();
        }
        else
        {
            $this->render('ready');
        }
    }
    
    
    /**
     * @return void
     */
    public function actionSuccess()
    {
        if (!Yii::app()->user->hasFlash('version'))
        {
            $this->redirect(array('index'));
        }
        
        $this->render('success', array('version' => Yii::app()->user->getFlash('version')));
    }

}