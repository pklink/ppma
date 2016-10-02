<?php

use Phinx\Migration\AbstractMigration;

class EntriesOwnerMigration extends AbstractMigration
{

    public function change()
    {
        $this->table('entries')
            ->addColumn('owner_id', 'integer', ['signed' => false])
            ->addIndex('owner_id')
            ->update();
    }

}
