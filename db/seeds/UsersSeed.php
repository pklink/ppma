<?php

use Phinx\Seed\AbstractSeed;

class UsersSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'username' => 'pierre',
                'password' => '$2y$10$aDTkMiY8zwkHcRC9V04LBel5yJ.0GZ8rjHE1gSQZwmXKA3QN4TEyq',
                'role_id'  => 1
            ],
            [
                'username' => 'peterchen',
                'password' => '$2y$10$aDTkMiY8zwkHcRC9V04LBel5yJ.0GZ8rjHE1gSQZwmXKA3QN4TEyq',
                'role_id'  => 2
            ]
        ];

        $this
            ->table('users')
            ->insert($data)
            ->save();
    }
}
