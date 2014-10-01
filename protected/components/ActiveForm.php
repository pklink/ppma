<?php

class ActiveForm extends CActiveForm
{
    public function error(
        $model,
        $attribute,
        $htmlOptions = array(),
        $enableAjaxValidation = true,
        $enableClientValidation = true
    ) {
        return str_replace(
            array('div', 'errorMessage'),
            array('small', 'error'),
            parent::error($model, $attribute, $htmlOptions, $enableAjaxValidation, $enableClientValidation)
        );
    }
}
