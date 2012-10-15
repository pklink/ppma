<?php

class m110313_194050_force_ssl extends CDbMigration
{
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#down()
     */
    public function down()
    {
        Setting::model()->deleteAllByAttributes(array(
            'name' => Setting::FORCE_SSL
        ));
    }
    
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#up()
     */
    public function up()
    {
        $setting = new Setting();
        $setting->name  = Setting::FORCE_SSL;
        $setting->value = 0;
        $setting->save();
    }
    
}