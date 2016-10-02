<?php

use Phinx\Seed\AbstractSeed;

class PermissionsSeed extends AbstractSeed
{

    public function run()
    {
        $data = [
            [
                'name' => 'Entries: Create',
                'id'   => 'entries.create'
            ],
            [
                'name' => 'Entries: Retrieve',
                'id'   => 'entries.retrieve'
            ],
            [
                'name' => 'Entries: Update',
                'id'   => 'entries.update'
            ],
            [
                'name' => 'Entries: Delete',
                'id'   => 'entries.delete'
            ],
            [
                'name' => 'Roles: Create',
                'id'   => 'roles.create'
            ],
            [
                'name' => 'Roles: Retrieve',
                'id'   => 'roles.retrieve'
            ],
            [
                'name' => 'Roles: Update',
                'id'   => 'roles.update'
            ],
            [
                'name' => 'Roles: Delete',
                'id'   => 'roles.delete'
            ],
            [
                'name' => 'Users: Create',
                'id'   => 'users.create'
            ],
            [
                'name' => 'Users: Retrieve',
                'id'   => 'users.retrieve'
            ],
            [
                'name' => 'Users: Update',
                'id'   => 'users.update'
            ],
            [
                'name' => 'Users: Delete',
                'id'   => 'users.delete'
            ],
        ];

        $this
            ->table('permissions')
            ->insert($data)
            ->save();
    }
}
