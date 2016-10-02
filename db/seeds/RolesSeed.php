<?php

use Phinx\Seed\AbstractSeed;

class RolesSeed extends AbstractSeed
{

    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Member',
            ]
        ];

        $this
            ->table('roles')
            ->insert($data)
            ->save();
    }
}
