<?php

class SetupController extends Controller
{

    /**
     *
     * @var string
     */
    public $layout = 'setup';

    /**
     *
     * @return void
     */
    public function actionIndex()
    {
        // get step
        $step = Yii::app()->request->getQuery('step', 1);

        // check if step is valid
        if (!in_array($step, array(1, 2, 3, 4))) {
            $step = 1;
        }

        switch ($step) {
            case 2:
                $this->actionStep2();
                break;

            case 3:
                $this->actionStep3();
                break;

            case 4:
                $this->actionStep4();
                break;

            case 1:
            default:
                $this->actionStep1();
        }
    }

    /**
     *
     * @return void
     */
    protected function actionStep2()
    {
        /* @var CreateConfigForm $model */
        $form = new CForm('application.views.setup.forms.step2', new CreateConfigForm());
        $model = $form->model;


        if (isset($_POST['CreateConfigForm'])) {
            $form->loadData();
        }

        // form is submitted & valid
        if (isset($_POST['CreateConfigForm']) && $form->validate()) {
            $configPath = Yii::getPathOfAlias('application.config.ppma') . '.php';

            // get config
            /** @noinspection PhpIncludeInspection */
            $config = require($configPath);

            // set config
            $config['db']['server'] = $model->server;
            $config['db']['port'] = $model->port;
            $config['db']['username'] = $model->username;
            $config['db']['password'] = $model->password;
            $config['db']['name'] = $model->name;

            // save config
            $config = new CConfiguration($config);
            file_put_contents($configPath, "<?php\n\nreturn " . $config->saveAsString() . ';');

            // create tables
            $this->createTables();

            // redirect to step 3
            $this->redirect(array('/setup/index', 'step' => 3));
        } elseif (isset($_POST['CreateConfigForm'])) { // form is submitted & invalid
            // if connection test failed, show error summary
            if ($model->hasErrors('db')) {
                $form->showErrorSummary = true;
            }
        } else { // set config in form
            // get config
            $configPath = Yii::getPathOfAlias('application.config.ppma') . '.php';
            /** @noinspection PhpIncludeInspection */
            $config = require($configPath);

            $model->server = $config['db']['server'];
            $model->username = $config['db']['username'];
            $model->password = $config['db']['password'];
            $model->name = $config['db']['name'];
        }

        $this->render('step2', array('form' => $form));
    }

    /**
     *
     * @return void
     */
    protected function createTables()
    {
        $command = Yii::app()->db->createCommand();

        // create Entry-table
        try {
            $command->dropTable('Entry');
        } catch (Exception $e) {
        }

        $command->createTable('Entry', array(
            'id' => 'pk',
            'userId' => 'integer NOT NULL',
            'name' => 'string',
            'url' => 'string',
            'comment' => 'text',
            'username' => 'string',
            'encryptedPassword' => 'binary',
            'viewCount' => 'int NOT NULL DEFAULT 0'
        ));

        // create EntryHasTag-table
        try {
            $command->dropTable('EntryHasTag');
        } catch (Exception $e) {
        }

        $command->createTable('EntryHasTag', array(
            'entryId' => 'integer NOT NULL',
            'tagId' => 'integer NOT NULL',
            'PRIMARY KEY (entryId, tagId)',
        ));

        // create Tag-table
        try {
            $command->dropTable('Tag');
        } catch (Exception $e) {
        }

        $command->createTable('Tag', array(
            'id' => 'pk',
            'name' => 'string',
            'userId' => 'integer NOT NULL',
        ));

        // create User-table
        try {
            $command->dropTable('User');
        } catch (Exception $e) {
        }

        $command->createTable('User', array(
            'id' => 'pk',
            'username' => 'string',
            'password' => 'string',
            'salt' => 'string',
            'encryptionKey' => 'binary',
            'isAdmin' => 'boolean',
        ));

        // create Setting-table
        try {
            $command->dropTable('Setting');
        } catch (Exception $e) {
        }

        $command->createTable('Setting', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'value' => 'string NOT NULL',
        ));

        // create "force ssl" default value
        $forceSsl = new Setting();
        $forceSsl->name = Setting::FORCE_SSL;
        $forceSsl->value = 0;
        $forceSsl->save();

        // add settings for recenent-entries-widget
        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();

        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_POSITION;
        $model->value = 2;
        $model->save(false);

        // add settings for "Most Viewed" widget
        $model = new Setting();
        $model->name = Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name = Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED;
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
    protected function actionStep3()
    {
        // create form
        $form = new CForm('application.views.setup.forms.register', new UserForm());

        // form is submitted
        if (isset($_POST['UserForm'])) {
            $form->loadData();

            if ($form->validate()) {
                /** @noinspection PhpUndefinedClassInspection */
                $model = new User();

                /** @noinspection PhpUndefinedFieldInspection */
                $model->username = $form->model->username;
                /** @noinspection PhpUndefinedFieldInspection */
                $model->password = $form->model->password;

                // attach eventhandler for padding password, generating encryption key and salting password
                $model->onBeforeSave[] = array($model, 'padPassword');
                $model->onBeforeSave[] = array($model, 'generateEncryptionKey');
                $model->onBeforeSave[] = array($model, 'saltPassword');

                // save user
                $model->isAdmin = true;
                $model->save(false);

                // redirect to step 4
                $this->redirect(array('setup/', 'step' => 4));
            }
        }

        $this->render('step3', array('form' => $form));
    }

    /**
     *
     * @return void
     */
    protected function actionStep4()
    {
        // Flag app as installed
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        /** @noinspection PhpIncludeInspection */
        $config = require($path);
        $config['isInstalled'] = true;
        $config = new CConfiguration($config);
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->render('step4');
    }

    protected function actionStep1()
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
        foreach ($pathes as $path) {
            $permissions[$path] = is_writeable($path);

            if (!$permissions[$path]) {
                $continue = false;
            }
        }

        // check php version
        $phpVersion = PHP_VERSION >= 5;

        if (!$phpVersion) {
            $continue = false;
        }

        // check for mcrypt
        $isMcryptLoaded = extension_loaded('mcrypt');

        if (!$isMcryptLoaded) {
            $continue = false;
        }

        // check for PDO
        $isPDOLoaded = extension_loaded('PDO');

        if (!$isPDOLoaded) {
            $continue = false;
        }

        // check for pdo_mysql
        $isPDO_mysqlLoaded = extension_loaded('pdo_mysql');

        if (!$isPDO_mysqlLoaded) {
            $continue = false;
        }

        $this->render('step1', array(
            'permissions' => $permissions,
            'phpVersion' => $phpVersion,
            'isMcryptLoaded' => $isMcryptLoaded,
            'isPDOLoaded' => $isPDOLoaded,
            'isPDO_mysqlLoaded' => $isPDO_mysqlLoaded,
            'continue' => $continue,
        ));
    }
}
