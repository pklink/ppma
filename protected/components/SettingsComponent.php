<?php

class SettingsComponent extends CApplicationComponent
{
    
    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        // try to retrieve model
        $model = Setting::model()->name($name)->find();
        
        // Setting exists -> return value
        if ($model instanceof Setting)
        {
            return $model->value;
        }
        
        // Setting does not extist -> return NULL
        else
        {
            return NULL;
        }
    }
     
    
    /**
     * Alias for SettingsComponent#getAsBoolean()
     * 
     * @see SettingsComponent#getAsBoolean()
     */
    public function getAsBool($name)
    {
        return $this->getAsBoolean($name);
    }
    
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    public function getAsBoolean($name)
    {
        return CPropertyValue::ensureBoolean( $this->get($name) );
    }
    
    
    /**
     * Alias for SettingsComponent#getAsInteger()
     *
     * @see SettingsComponent#getAsInteger()
     */
    public function getAsInt($name)
    {
        return $this->getAsInteger($name);
    }
    
    
    /**
     * 
     * @param string $name
     * @return integer
     */
    public function getAsInteger($name)
    {
        return CPropertyValue::ensureInteger( $this->get($name) );
    }
    
}