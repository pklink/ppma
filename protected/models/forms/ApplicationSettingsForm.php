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
     * @return array
     */
    public function rules()
    {
        return array(
            array('forceSSL', 'boolean'),
            array('recentEntryWidgetEnabled', 'boolean'),
            array('recentEntryWidgetCount', 'required', 'message' => 'Field cannot be blank.'),
            array(
                'recentEntryWidgetCount',
                'numerical',
                'min' => 1,
                'skipOnError' => true,
                'tooSmall' => 'Number is too small.'
            ),
            array('mostViewedEntriesWidgetEnabled', 'boolean'),
            array('mostViewedEntriesWidgetCount', 'required', 'message' => 'Field cannot be blank.'),
            array(
                'mostViewedEntriesWidgetCount',
                'numerical',
                'min' => 1,
                'skipOnError' => true,
                'tooSmall' => 'Number is too small.'
            ),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'forceSSL' => 'Force SSL/HTTPS using',
            'recentEntryWidgetEnabled' => 'Enabled "Recent Entries" widget',
            'recentEntryWidgetCount' => 'Number of entries in the "Recent Entries" widget',
            'mostViewedEntriesWidgetEnabled' => 'Enabled "Most Viewed" widget',
            'mostViewedEntriesWidgetCount' => 'Number of entries in the "Most Viewed" widget',
        );
    }

    /**
     * @retunr void
     */
    protected function afterConstruct()
    {
        /* @var SettingsComponent $settings */
        /** @noinspection PhpUndefinedFieldInspection */
        $settings = Yii::app()->settings;

        $this->forceSSL = $settings->get(Setting::FORCE_SSL);
        $this->recentEntryWidgetEnabled = $settings->get(Setting::RECENT_ENTRIES_WIDGET_ENABLED);
        $this->recentEntryWidgetCount = $settings->get(Setting::RECENT_ENTRIES_WIDGET_COUNT);
        $this->mostViewedEntriesWidgetEnabled = $settings->get(Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED);
        $this->mostViewedEntriesWidgetCount = $settings->get(Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT);

        parent::afterConstruct();
    }
}
