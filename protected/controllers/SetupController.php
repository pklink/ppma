<?php

class SetupController extends Controller
{

    /**
     *
     * @var string
     */
    public $layout = 'setup';

    protected function _actionStep1()
    {
        $continue = true;

        // directories need to be writable
        $pathes = array(
            Yii::getPathOfAlias('webroot.assets'),
            Yii::getPathOfAlias('application.runtime'),
            Yii::getPathOfAlias('application.config.ppma') . '.php',
        );

        // check permissions
        $permissions = array();
        foreach ($pathes as $path)
        {
            $permissions[$path] = is_writeable($path);

            if (!$permissions[$path])
            {
                $continue = false;
            }
        }

        // check php version
        $phpVersion = PHP_VERSION >= 5;

        if (!$phpVersion)
        {
            $continue = false;
        }

        // check for mcrypt
        $isMcryptLoaded = extension_loaded('mcrypt');

        if (!$isMcryptLoaded)
        {
            $continue = false;
        }

        // check for PDO
        $isPDOLoaded = extension_loaded('PDO');

        if (!$isPDOLoaded)
        {
            $continue = false;
        }

        // check for pdo_mysql
        $isPDO_mysqlLoaded = extension_loaded('pdo_mysql');

        if (!$isPDO_mysqlLoaded)
        {
            $continue = false;
        }

        if ($continue)
        {
            Yii::app()->user->setState('step', 2);
        }

        $this->render('step1', array(
            'permissions'       => $permissions,
            'phpVersion'        => $phpVersion,
            'isMcryptLoaded'    => $isMcryptLoaded,
            'isPDOLoaded'       => $isPDOLoaded,
            'isPDO_mysqlLoaded' => $isPDO_mysqlLoaded,
            'continue'          => $continue,
        ));
    }

    /**
     *
     * @return void
     */
    protected function _actionStep2()
    {
        $form = new CForm('application.views.setup.forms.step2', new CreateConfigForm());

        if (isset($_POST['CreateConfigForm'])) {
            $form->loadData();
        }

        // form is submitted & valid
        if (isset($_POST['CreateConfigForm']) && $form->validate())
        {
            $configPath = Yii::getPathOfAlias('application.config.ppma') . '.php';

            // get config
            $config = require($configPath);

            // set config
            $config['db']['server']      = $form->model->server;
            $config['db']['username']    = $form->model->username;
            $config['db']['password']    = $form->model->password;
            $config['db']['name']        = $form->model->name;

            // save config
            $config = new CConfiguration($config);
            file_put_contents($configPath, "<?php\n\nreturn " . $config->saveAsString() . ';');

            // create tables
            $this->_createTables();

            // set step in session and redirect
            Yii::app()->user->setState('step', 3);
            $this->redirect(array('/setup/index', 'step' => 3));
        }

        // form is submitted & invalid
        else if (isset($_POST['CreateConfigForm']))
        {
            // if connection test failed, show error summary
            if ($form->model->hasErrors('db'))
            {
                $form->showErrorSummary = true;
            }
        }

        // set config in form
        else
        {
            // get config
            $configPath = Yii::getPathOfAlias('application.config.ppma') . '.php';
            $config = require($configPath);

            $form->model->server   = $config['db']['server'];
            $form->model->username = $config['db']['username'];
            $form->model->password = $config['db']['password'];
            $form->model->name     = $config['db']['name'];
        }

        $this->render('step2', array('form' => $form));
    }


    /**
     *
     * @return void
     */
    protected function _actionStep3()
    {
        // create form
        $form = new CForm('application.views.setup.forms.register', new User());

        if (isset($_POST['User'])) {
            $form->loadData();
        }

        // form is submitted
        if (isset($_POST['User']))
        {
            // attach eventhandler for padding password, generating encryption key and salting password
            $form->model->onBeforeValidate[] = array($form->model, 'padPassword');
            $form->model->onBeforeValidate[] = array($form->model, 'generateEncryptionKey');
            $form->model->onBeforeValidate[] = array($form->model, 'saltPassword');

            // validate form
            if ($form->validate())
            {
                // save user
                $form->model->isAdmin = true;
                $form->model->save(false);

                // set step in session and redirect
                Yii::app()->user->setState('step', 4);
                $this->redirect(array('setup/', 'step' => 4));
            }
        }

        $this->render('step3', array('form' => $form));
    }


    /**
     *
     * @return void
     */
    protected function _actionStep4()
    {
        // Remove step from session
        Yii::app()->user->setState('step', 0, 0);

        // Flag app as installed
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = require($path);
        $config['isInstalled'] = true;
        $config = new CConfiguration($config);
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->render('step4');
    }

    
    /**
     * 
     * @return void
     */
    protected function _createTables()
    {
        $command = Yii::app()->db->createCommand();

        // create Entry-table
        try {
            $command->dropTable('Entry');
        } catch (Exception $e) { }

        $command->createTable('Entry', array(
            'id'                => 'pk',
            'userId'            => 'integer NOT NULL',
            'name'              => 'string',
            'url'               => 'string',
            'comment'           => 'text',
            'username'          => 'string',
            'encryptedPassword' => 'binary',
            'viewCount'         => 'int NOT NULL DEFAULT 0'
        ));

        // create EntryHasTag-table
        try {
            $command->dropTable('EntryHasTag');
        } catch (Exception $e) { }

        $command->createTable('EntryHasTag', array(
            'entryId' => 'integer NOT NULL',
            'tagId'   => 'integer NOT NULL',
            'PRIMARY KEY (entryId, tagId)',
        ));
        
        // create Tag-table
        try {
            $command->dropTable('Tag');
        } catch (Exception $e) { }

        $command->createTable('Tag', array(
            'id'     => 'pk',
            'name'   => 'string',
            'userId' => 'integer NOT NULL',
        ));
        
        // create User-table
        try {
            $command->dropTable('User');
        } catch (Exception $e) { }

        $command->createTable('User', array(
            'id'            => 'pk',
            'username'      => 'string',
            'password'      => 'string',
            'salt'          => 'string',
            'encryptionKey' => 'binary',
            'isAdmin'       => 'boolean',
        ));
        
        // create Setting-table
        try {
            $command->dropTable('Setting');
        } catch (Exception $e) { }

        $command->createTable('Setting', array(
            'id'    => 'pk',
            'name'  => 'string NOT NULL',
            'value' => 'string NOT NULL',
        ));
        
        // create "force ssl" default value
        $forceSsl = new Setting();
        $forceSsl->name  = Setting::FORCE_SSL;
        $forceSsl->value = 0;
        $forceSsl->save();

        // add settings for recenent-entries-widget
        $model = new Setting();
        $model->name  = Setting::RECENT_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name  = Setting::RECENT_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();

        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_POSITION;
        $model->value = 2;
        $model->save(false);

        // add settings for "Most Viewed" widget
        $model = new Setting();
        $model->name  = Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name  = Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();

        $model = new Setting();
        $model->name = Setting::MOST_VIEWED_ENTRIES_WIDGET_POSITION;
        $model->value = 1;
        $model->save(false);

        // add settings for "Tag Cloud" widget
        $model = new Setting();
        $model->name = Setting::TAG_CLOUD_WIDGET_POSITION;
        $model->value = 0;
        $model->save(false);

        $model = new Setting();
        $model->name = Setting::PAGINATION_PAGE_SIZE_ENTRIES;
        $model->value = 10;
        $model->save(false);

        $model = new Setting();
        $model->name = Setting::PAGINATION_PAGE_SIZE_TAGS;
        $model->value = 10;
        $model->save(false);
    }
    

    /**
     *
     * @return void
     */
    public function actionIndex()
    {
        // get step
        $step = Yii::app()->request->getQuery('step', 1);

        if ($step > Yii::app()->user->getState('step', 1))
        {
            $this->redirect(array('setup/index', 'step' => Yii::app()->user->getState('step')));
        }

        switch ($step)
        {
            case 2:
                $this->_actionStep2();
                break;

            case 3:
                $this->_actionStep3();
                break;

            case 4:
                $this->_actionStep4();
                break;

            case 1:
            default:
                $this->_actionStep1();
        }
    }

}
