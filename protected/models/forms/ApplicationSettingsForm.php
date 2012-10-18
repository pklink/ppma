<?php

class ApplicationSettingsForm extends CFormModel
{
    
    /**
     * 
     * @var boolean
     */
    public $forceSSL;


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('forceSSL', 'required'),
            array('forceSSL', 'boolean', 'skipOnError' => true),
        );
    }
    
    
    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#afterConstruct()
     */
    protected function afterConstruct()
    {
        $this->forceSSL            = Yii::app()->settings->get( Setting::FORCE_SSL );
        
        return parent::afterConstruct();
    }


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'forceSSL'            => 'Force SSL/HTTPS using',
        );
    }

}
