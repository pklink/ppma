<?php

use Phinx\Seed\AbstractSeed;

class RolesPermissionsSeed extends AbstractSeed
{

    public function run()
    {
        $data = [
            // Admin
            [
                'role_id'       => 1,
                'permission_id' => 'entries.create'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'entries.retrieve'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'entries.update'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'entries.delete'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'roles.create'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'roles.retrieve'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'roles.update'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'roles.delete'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'users.create'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'users.retrieve'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'users.update'
            ],
            [
                'role_id'       => 1,
                'permission_id' => 'users.delete'
            ],

            // Member
            [
                'role_id'       => 2,
                'permission_id' => 'entries.create'
            ],
            [
                'role_id'       => 2,
                'permission_id' => 'entries.retrieve'
            ],
            [
                'role_id'       => 2,
                'permission_id' => 'entries.update'
            ],
            [
                'role_id'       => 2,
                'permission_id' => 'entries.delete'
            ]
        ];

        $this
            ->table('roles_permissions')
            ->insert($data)
            ->save();
    }

}
