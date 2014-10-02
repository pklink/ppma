<?php

class UserController extends Controller
{

    /**
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('logout'),
                'users' => array('@'),
            ),
            array(
                'allow',
                'actions' => array('login'),
                'users' => array('*'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * @return void
     */
    public function actionLogin()
    {
        // check if user is logged in
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('/entry/index'));
        }

        $this->layout = 'login';

        $model = new LoginForm();

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate()) {
                $this->redirect(array('/entry/index'));
            }
        }

        $this->render('login', array('model' => $model));
    }

    /**
     * @return void
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * @return array
     */
    public function filters()
    {
        return array_merge(array(
            'accessControl',
        ), parent::filters());
    }
}
