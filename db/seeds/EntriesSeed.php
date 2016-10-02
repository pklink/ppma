<?php

use Phinx\Seed\AbstractSeed;

class EntriesSeed extends AbstractSeed
{

    public function run()
    {
        $data = [
            [
                'name'     => 'github.com',
                'username' => 'pklink',
                'password' => '123456',
                'owner_id' => 1,
            ],
            [
                'name'     => 'domain.com',
                'username' => 'peterchen',
                'password' => '123456',
                'owner_id' => 2,
            ]
        ];

        $this
            ->table('entries')
            ->insert($data)
            ->save();
    }

}
