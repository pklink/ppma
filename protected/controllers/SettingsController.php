<?php

class SettingsController extends Controller
{

    /**
     *
     * @var string
     */
    public $layout = 'column2';


    /**
     *
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('password', 'index'),
                'users'   => array('@'),
            ),
            array(
                'allow',
                'actions'    => array('application'),
                'users'      => array('@'),
                'expression' => 'Yii::app()->user->isAdmin',
            ),
            array(
                'deny',
                'users'   => array('*'),
            ),
        );
    }


    /**
     *
     * @return void
     */
    public function actionPassword()
    {
        $model = new PasswordForm();

        if (isset($_POST['PasswordForm']))
        {
            $model->attributes = $_POST['PasswordForm'];

            if ($model->validate())
            {
                // get user from db
                $user = User::model()->findByPk(Yii::app()->user->id);

                // set new password
                $user->password = Yii::app()->securityManager->padUserPassword($model->newPassword);

                // encrypt encryptionKey with new password
                $user->encryptionKey = Yii::app()->securityManager->encrypt(Yii::app()->user->encryptionKey, $user->password);

                // salt password
                $user->saltPassword(new CEvent());

                // save user record
                $user->save(false);

                // set success-flash & refresh page
                Yii::app()->user->setFlash('success', 'Your password was changed successfully.');
                $this->refresh();
            }
        }

        $this->render('password', array('model' => $model));
    }

    
    /**
     * 
     * @return void
     */
    public function actionRegistration()
    {
        $form = new CForm('application.views.settings.forms.registration', new RegistrationSettingsForm());

        // form is submitted and valid
        if ($form->submitted('save') && $form->validate())
        {
            // save settings
            $model = Setting::model()->name( Setting::REGISTRATION_ENABLED )->find();
            $model->value = $form->model->registrationEnabled;
            $model->save(false);
            
            // set flash an refresh
            Yii::app()->user->setFlash('success', true);
            $this->refresh();
        }        
        
        $this->render('registration', array('form' => $form));
    }

    
    /**
     * 
     * @return void
     */
    public function actionApplication()
    {
        $form = new CForm('application.views.settings.forms.application', new ApplicationSettingsForm());

        // form is submitted and valid
        if ($form->submitted('save') && $form->validate())
        {
            // save registration-setting
            $model = Setting::model()->name( Setting::REGISTRATION_ENABLED )->find();
            $model->value = $form->model->registrationEnabled;
            $model->save(false);
            
            // save ssl-setting
            $model = Setting::model()->name( Setting::FORCE_SSL )->find();
            $model->value = $form->model->forceSSL;
            $model->save(false);
            
            // set flash an refresh
            Yii::app()->user->setFlash('success', true);
            $this->refresh();
        }        
        
        $this->render('application', array('form' => $form));
    }
    

    /**
     * (non-PHPdoc)
     * @see yii/web/CController#filters()
     */
    public function filters()
    {
        return array_merge(array(
            'accessControl',
        ), parent::filters());
    }

}