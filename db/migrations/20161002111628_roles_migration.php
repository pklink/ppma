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
            ->addForeignKey('role_id', 'roles', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->update();
    }

}
