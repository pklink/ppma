<?php

use Phinx\Migration\AbstractMigration;

class RolesMigration extends AbstractMigration
{

    public function change()
    {
        $this->table('roles')
            ->addColumn('name', 'string')
            ->addIndex(['name'], ['unique' => true])
            ->create();

        $this->table('users')
            ->addColumn('role_id', 'integer')
            ->update();
    }

}
