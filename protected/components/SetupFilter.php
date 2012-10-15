<?php

class SetupFilter extends CFilter
{

    /**
     * (non-PHPdoc)
     * @see yii/CFilter#preFilter($filterChain)
     */
    protected function preFilter($filterChain)
    {
        // app isn't installed & current controller isn't SetupController -> redirect to /setup
        if (!Yii::app()->params['isInstalled'] && $filterChain->controller->id != 'setup')
        {
            $filterChain->controller->redirect(array('setup/'));
            return false;
        }

        // app is installed & current controller is SetupController -> redirect to homeUrl
        else if (Yii::app()->params['isInstalled'] && $filterChain->controller->id == 'setup')
        {
            $filterChain->controller->redirect(Yii::app()->homeUrl);
            return false;
        }

        return true;
    }

}