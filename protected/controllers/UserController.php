<?php

class UserController extends Controller
{

    /**
     * (non-PHPdoc)
     * @see yii/CController#accessRules()
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('logout'),
                'users'   => array('@'),
            ),
            array(
                'allow',
                'actions' => array('login'),
                'users'   => array('?'),
            ),
            array(
                'allow',
                'actions'    => array('register'),
                'users'      => array('?'),
                'expression' => 'Yii::app()->settings->getAsBool(Setting::REGISTRATION_ENABLED)', 
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
    public function actionLogin()
    {
        $this->layout = 'login';

        $model = new LoginForm();

        if(isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate())
            {
                $this->redirect(array('/entry/index'));
            }
        }

        $this->render('login', array('model' => $model));
    }


    /**
     *
     * @return void
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }


    /**
     *
     * @return void
     */
    public function actionRegister()
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
                $form->model->save(false);

                // set flash and refresh page
                Yii::app()->user->setFlash('success', true);
                $this->refresh();
            }
        }

        $this->render('register', array('form' => $form));
    }


    /**
     *
     * @return array
     */
    public function filters()
    {
        return array_merge(array(
            'accessControl',
        ), parent::filters());
    }

}