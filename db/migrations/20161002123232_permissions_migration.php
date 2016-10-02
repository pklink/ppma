<?php

use Phinx\Migration\AbstractMigration;

class PermissionsMigration extends AbstractMigration
{

    public function change()
    {
        $this->table('permissions', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 64])
            ->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addIndex(['name'])
            ->create();
    }

}
