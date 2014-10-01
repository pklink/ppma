<?php

class SettingsComponent extends CApplicationComponent
{

    /**
     * @param string $name
     * @return bool
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
        return CPropertyValue::ensureBoolean($this->get($name));
    }

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
        if ($model instanceof Setting) {
            return $model->value;
        } else { // Setting does not extist -> return null
            return null;
        }
    }

    /**
     * @param string $name
     * @return int
     */
    public function getAsInt($name)
    {
        return $this->getAsInteger($name);
    }

    /**
     * @param string $name
     * @return integer
     */
    public function getAsInteger($name)
    {
        return CPropertyValue::ensureInteger($this->get($name));
    }
}
