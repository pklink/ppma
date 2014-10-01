<?php

class SetupFilter extends CFilter
{

    /**
     * @param CFilterChain $filterChain
     * @return bool
     */
    protected function preFilter($filterChain)
    {
        // app isn't installed & current controller isn't SetupController -> redirect to /setup
        if (!Yii::app()->params['isInstalled'] && $filterChain->controller->id != 'setup') {
            $filterChain->controller->redirect(array('setup/'));
            return false;
        } elseif (Yii::app()->params['isInstalled'] && $filterChain->controller->id == 'setup') {
            $filterChain->controller->redirect(Yii::app()->homeUrl);
            return false;
        }

        return true;
    }
}
