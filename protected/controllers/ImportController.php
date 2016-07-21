<?php

class ImportController extends Controller
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
                'actions'    => array('csv', 'phppassmanager'),
                'users'      => array('@'),
                'expression' => 'Yii::app()->user->isAdmin',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }


    /**
     * @return array
     */
    public function actions()
    {
        return array(
            'csv'            => 'application.controllers.import.CSVAction',
            'phppassmanager' => 'application.controllers.import.PHPPassManagerAction',
        );
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
