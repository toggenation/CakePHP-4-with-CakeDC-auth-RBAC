<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class DropUsersAndCreateAnotherUserTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->drop()->save();

        $this->table('another_users')
            ->addColumn('is_superuser', 'boolean', ['default' => false])
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('role', 'string')
            ->create();

        $this->table('posts')
            ->renameColumn('user_id', 'another_user_id')
            ->update();
    }
}
