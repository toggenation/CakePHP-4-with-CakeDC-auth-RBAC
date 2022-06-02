<?php

declare(strict_types=1);

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Migrations\AbstractSeed;

/**
 * AddUsers seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => (new DefaultPasswordHasher())->hash('123'),
                'is_superuser' => 1,
                'role' => 'admin'
            ],
            [
                'username' => 'user',
                'password' => (new DefaultPasswordHasher())->hash('123'),
                'is_superuser' => 0,
                'role' => 'user'
            ]
        ];

        $table = $this->table('users');

        $table->truncate();

        $table->insert($data)->save();
    }
}
