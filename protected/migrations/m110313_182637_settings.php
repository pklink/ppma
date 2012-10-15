<?php

class m110313_182637_settings extends CDbMigration
{
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#down()
     */
    public function down()
    {
        $this->dropTable('Setting');
    }
    
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#up()
     */
    public function up()
    {
        // create table
        $this->createTable('Setting', array(
            'id'    => 'pk',
            'name'  => 'string NOT NULL',
            'value' => 'string NOT NULL',
        ));
        
        // create init values
        $registrationEnabled = new Setting();
        $registrationEnabled->name  = Setting::REGISTRATION_ENABLED;
        $registrationEnabled->value = 0;
        $registrationEnabled->save();
    }

}