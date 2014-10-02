<?php

class SiteController extends Controller
{

    /**
     * @return void
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    /**
     * @return void
     */
    public function actionIndex()
    {
        $this->redirect(array('/user/login'));
    }
}
