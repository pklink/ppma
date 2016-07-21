<?php

class ExportController extends Controller
{

    /**
     * @var string
     */
    public $layout = 'column2';

    /**
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('csv'),
                'users' => array('@'),
                'expression' => 'Yii::app()->user->isAdmin',
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
    public function actionCsv()
    {
        Yii::import('ext.ECSVExport');

        $data = array();
        foreach (Entry::model()->findAllByAttributes(array('userId' => Yii::app()->user->id)) as $model) {
            /* @var Entry $model */

            $data[] = array(
                'name' => $model->name,
                'url' => $model->url,
                'comment' => $model->comment,
                'tags' => $model->tagList,
                'username' => $model->username,
                'password' => $model->password,
            );
        }

        $csv = new ECSVExport($data);
        Yii::app()->request->sendFile(sprintf('ppma-export-%s.csv', date('YmdHis')), $csv->toCSV(), 'text/csv', false);
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
