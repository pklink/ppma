<?php

class m110314_203716_tag_userId extends CDbMigration
{
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#down()
     */
    public function down()
    {
        $this->dropColumn('Tag', 'userId');
        $this->dropForeignKey('user', 'Tag');
    }
    
    
    /**
     * (non-PHPdoc)
     * @see yii/db/CDbMigration#up()
     */
    public function up()
    {
        $this->addColumn('Tag', 'userId', 'integer NOT NULL');
        $this->addForeignKey('user', 'Tag', 'userId', 'User', 'id', 'CASCADE', 'CASCADE');
    }
    
}