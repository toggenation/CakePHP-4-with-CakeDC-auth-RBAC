<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('posts')
            ->addColumn('body', 'string')
            ->addColumn('title', 'string')
            ->addColumn('user_id', 'integer')
            ->addTimestamps('created', 'modified')
            ->create();

        $this->table('users')
            ->addColumn('is_superuser', 'boolean', ['default' => false])
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('role', 'string')
            ->create();
    }
}
