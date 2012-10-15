<?php

class m110313_164620_init extends CDbMigration
{
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#down()
     */
    public function down()
    {
        $this->dropTable('Entry');
        $this->dropTable('EntryHasTag');
        $this->dropTable('Tag');
        $this->dropTable('User');
    }
    
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#up()
     */
    public function up()
    {
        $this->createTable('Entry', array(
            'id'                => 'pk',
            'userId'            => 'integer NOT NULL',
            'name'              => 'string',
            'url'               => 'string',
            'comment'           => 'text',
            'username'          => 'string',
            'encryptedPassword' => 'binary',
        ));
        
        $this->createTable('EntryHasTag', array(
            'entryId' => 'integer NOT NULL',
            'tagId'   => 'integer NOT NULL',
            'PRIMARY KEY (entryId, tagId)',
        ));
        
        $this->createTable('Tag', array(
            'id'   => 'pk',
            'name' => 'string',
        ));
        
        $this->createTable('User', array(
            'id'            => 'pk',
            'username'      => 'string',
            'password'      => 'string',
            'salt'          => 'string',
            'encryptionKey' => 'binary',
            'isAdmin'       => 'boolean',
        ));
    }
    
}