<?php

class ApplicationSettingsForm extends CFormModel
{
    
    /**
     * 
     * @var boolean
     */
    public $forceSSL;

    /**
     *
     * @var boolean
     */
    public $registrationEnabled;
    

    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('forceSSL', 'required'),
            array('forceSSL', 'boolean', 'skipOnError' => true),
        
            array('registrationEnabled', 'required'),
            array('registrationEnabled', 'boolean', 'skipOnError' => true),
        );
    }
    
    
    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#afterConstruct()
     */
    protected function afterConstruct()
    {
        $this->registrationEnabled = Yii::app()->settings->get( Setting::REGISTRATION_ENABLED );
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
            'registrationEnabled' => 'Registration is enabled',
        );
    }

}
