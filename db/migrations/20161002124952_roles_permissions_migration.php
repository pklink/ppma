<?php

use Phinx\Migration\AbstractMigration;

class RolesPermissionsMigration extends AbstractMigration
{

    public function change()
    {
        $this->table('roles_permissions', ['id' => false, 'primary_key' => ['role_id', 'permission_id']])
            ->addColumn('role_id', 'integer')
            ->addColumn('permission_id', 'string', ['limit' => 64])
            ->create();
    }

}
