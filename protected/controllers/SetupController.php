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

        if ($continue)
        {
            Yii::app()->user->setState('step', 2);
        }

        $this->render('step1', array(
            'permissions' => $permissions,
            'phpVersion'  => $phpVersion,
            'continue'    => $continue,
        ));
    }

    /**
     *
     * @return void
     */
    protected function _actionStep2()
    {
        $form = new CForm('application.views.setup.forms.step2', new CreateConfigForm());

        // form is submitted & valid
        if ($form->submitted('create') && $form->validate())
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
            $this->redirect(array('setup/', 'step' => 3));
        }

        // form is submitted & invalid
        else if ($form->submitted('create'))
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
        $form = new CForm('application.views.user.forms.register', new User());

        // form is submitted
        if ($form->submitted('register'))
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
        $command->createTable('Entry', array(
            'id'                => 'pk',
            'userId'            => 'integer NOT NULL',
            'name'              => 'string',
            'url'               => 'string',
            'comment'           => 'text',
            'username'          => 'string',
            'encryptedPassword' => 'binary',
        ));
        
        // create EntryHasTag-table
        $command->createTable('EntryHasTag', array(
            'entryId' => 'integer NOT NULL',
            'tagId'   => 'integer NOT NULL',
            'PRIMARY KEY (entryId, tagId)',
        ));
        
        // create Tag-table
        $command->createTable('Tag', array(
            'id'     => 'pk',
            'name'   => 'string',
            'userId' => 'integer NOT NULL',
        ));
        
        // create User-table
        $command->createTable('User', array(
            'id'            => 'pk',
            'username'      => 'string',
            'password'      => 'string',
            'salt'          => 'string',
            'encryptionKey' => 'binary',
            'isAdmin'       => 'boolean',
        ));
        
        // create Setting-table
        $command->createTable('Setting', array(
            'id'    => 'pk',
            'name'  => 'string NOT NULL',
            'value' => 'string NOT NULL',
        ));
        
        // create "registration enabled" default value
        $registrationEnabled = new Setting();
        $registrationEnabled->name  = Setting::REGISTRATION_ENABLED;
        $registrationEnabled->value = 0;
        $registrationEnabled->save();
        
        // create "force ssl" default value
        $forceSsl = new Setting();
        $forceSsl->name  = Setting::FORCE_SSL;
        $forceSsl->value = 0;
        $forceSsl->save();
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
            $this->redirect(array('setup/', 'step' => Yii::app()->user->getState('step', 1)));
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