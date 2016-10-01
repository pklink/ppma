<?php

use Phinx\Migration\AbstractMigration;

class EntriesMigration extends AbstractMigration
{

    public function change()
    {
        $this->table('entries')
            ->addColumn('name', 'string')
            ->addColumn('username', 'string')
            ->addColumn('password', 'text')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['name'])
            ->addIndex(['username'])
            ->create();

    }

}
