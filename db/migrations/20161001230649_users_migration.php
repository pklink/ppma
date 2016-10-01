<?php

use Phinx\Migration\AbstractMigration;

class UsersMigration extends AbstractMigration
{

    public function change()
    {
        $this->table('users')
            ->addColumn('username', 'string')
            ->addColumn('password', 'string', ['limit' => 60])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['username'], ['unique' => true])
            ->create();
    }

}
