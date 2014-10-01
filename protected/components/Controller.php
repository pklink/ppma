<?php

class Controller extends CController
{

    /**
     *
     * @var string
     */
    public $layout = 'column1';

    /**
     *
     * @var array
     */
    public $menu = array();

    /**
     * @var array
     */
    public $breadcrumbs = array();


    /**
     * (non-PHPdoc)
     * @see yii/CController#filters()
     */
    public function filters()
    {
        return array_merge(array(
            array('SetupFilter'),
            array('SslFilter')
        ), parent::filters());
    }
}
