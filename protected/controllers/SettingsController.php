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
                'actions' => array('password'),
                'users'   => array('@'),
            ),
            array(
                'allow',
                'actions'    => array('application', 'setSidebarPositions'),
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
     * @throws CHttpException
     * @return void
     */
    public function actionSetSidebarPositions()
    {
        // only ajax-request are allowed
        if (!Yii::app()->request->isAjaxRequest)
        {
            throw new CHttpException(400);
        }

        $neededParams = array(
            Setting::MOST_VIEWED_ENTRIES_WIDGET_POSITION,
            Setting::RECENT_ENTRIES_WIDGET_POSITION,
            Setting::TAG_CLOUD_WIDGET_POSITION,
        );

        // check if all needed params exist
        foreach ($neededParams as $paramName)
        {
            if (!isset($_POST[$paramName]))
            {
                throw new CHttpException(401);
            }
        }

        // save settings
        foreach ($neededParams as $paramName)
        {
            /* @var Setting $model */
            $param = CPropertyValue::ensureInteger($_POST[$paramName]);
            $model = Setting::model()->findByAttributes(array('name' => $paramName));
            $model->value = $param;
            $model->save();
        }

        echo '1';
    }


    /**
     * @return void
     */
    public function actionApplication()
    {
        $model = new ApplicationSettingsForm();

        // form is submitted and valid
        if (isset($_POST['ApplicationSettingsForm']))
        {
            $model->attributes = $_POST['ApplicationSettingsForm'];

            if ($model->validate())
            {
                // save settings
                $setting = Setting::model()->name( Setting::FORCE_SSL )->find();
                $setting->value = $model->forceSSL;
                $setting->save(false);

                $setting = Setting::model()->name( Setting::RECENT_ENTRIES_WIDGET_ENABLED )->find();
                $setting->value = $model->recentEntryWidgetEnabled;
                $setting->save(false);

                $setting = Setting::model()->name( Setting::RECENT_ENTRIES_WIDGET_COUNT )->find();
                $setting->value = $model->recentEntryWidgetCount;
                $setting->save(false);

                $setting = Setting::model()->name( Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED )->find();
                $setting->value = $model->mostViewedEntriesWidgetEnabled;
                $setting->save(false);

                $setting = Setting::model()->name( Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT )->find();
                $setting->value = $model->mostViewedEntriesWidgetCount;
                $setting->save(false);

                // set flash and refresh
                Yii::app()->user->setFlash('success', 'Settings were updated successfully.');
                $this->refresh();
            }
        }
        
        $this->render('application', array('model' => $model));
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