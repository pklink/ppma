<?php

use Phinx\Seed\AbstractSeed;

class UsersSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'username' => 'pierre',
                'password' => '$2y$10$8mQDHIQm/nPsK7xeNnfCR.QzatlHvj6VgIWntoedwkzkBvbwuuZQO'
            ]
        ];

        $this
            ->table('users')
            ->insert($data)
            ->save();
    }
}
