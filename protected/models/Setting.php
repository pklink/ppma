<?php

/**
 *
 * @property integer $id
 * @property string  $name 
 * @property string  $value
 */
class Setting extends CActiveRecord
{
    
    const FORCE_SSL = 'force_ssl';

    const RECENT_ENTRIES_WIDGET_ENABLED = 'recent_entries_widget_enabled';

    const RECENT_ENTRIES_WIDGET_COUNT   = 'recent_entries_widget_count';

    const MOST_VIEWED_ENTRIES_WIDGET_ENABLED = 'most_viewed_entries_widget_enabled';

    const MOST_VIEWED_ENTRIES_WIDGET_COUNT   = 'most_viewed_entries_widget_count';
    
    
    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'id'    => 'ID',
            'name'  => 'Name',
            'value' => 'Value',
        );
    }


    /**
     *
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    
    /**
     * Scope
     *
     * @param string $name
     * @return Tag
     */
    public function name($name)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'name=:name',
            'params'    => array(':name' => $name),
        ));

        return $this;
    }
    

    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('value', 'required'),
        );
    }

}