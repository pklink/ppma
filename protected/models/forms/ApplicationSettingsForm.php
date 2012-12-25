<?php

class ApplicationSettingsForm extends CFormModel
{
    
    /**
     * @var boolean
     */
    public $forceSSL;

    /**
     * @var boolean
     */
    public $recentEntryWidgetEnabled;

    /**
     * @var boolean
     */
    public $recentEntryWidgetCount;

    /**
     * @var boolean
     */
    public $mostViewedEntriesWidgetEnabled;

    /**
     * @var boolean
     */
    public $mostViewedEntriesWidgetCount;


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('forceSSL', 'boolean'),
            array('recentEntryWidgetEnabled', 'boolean'),
            array('recentEntryWidgetCount', 'required', 'message' => 'Field cannot be blank.'),
            array('recentEntryWidgetCount', 'numerical', 'min' => 1, 'skipOnError' => true, 'tooSmall' => 'Number is too small.'),
            array('mostViewedEntriesWidgetEnabled', 'boolean'),
            array('mostViewedEntriesWidgetCount', 'required', 'message' => 'Field cannot be blank.'),
            array('mostViewedEntriesWidgetCount', 'numerical', 'min' => 1, 'skipOnError' => true, 'tooSmall' => 'Number is too small.'),
        );
    }
    
    
    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#afterConstruct()
     */
    protected function afterConstruct()
    {
        $this->forceSSL                       = Yii::app()->settings->get( Setting::FORCE_SSL );
        $this->recentEntryWidgetEnabled       = Yii::app()->settings->get( Setting::RECENT_ENTRIES_WIDGET_ENABLED );
        $this->recentEntryWidgetCount         = Yii::app()->settings->get( Setting::RECENT_ENTRIES_WIDGET_COUNT );
        $this->mostViewedEntriesWidgetEnabled = Yii::app()->settings->get( Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED );
        $this->mostViewedEntriesWidgetCount   = Yii::app()->settings->get( Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT );
        
        return parent::afterConstruct();
    }


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'forceSSL'                       => 'Force SSL/HTTPS using',
            'recentEntryWidgetEnabled'       => 'Enabled "Recent Entries" widget',
            'recentEntryWidgetCount'         => 'Number of entries in the "Recent Entries" widget',
            'mostViewedEntriesWidgetEnabled' => 'Enabled "Most Viewed" widget',
            'mostViewedEntriesWidgetCount'   => 'Number of entries in the "Most Viewed" widget',
        );
    }

}
