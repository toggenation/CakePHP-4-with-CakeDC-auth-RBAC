<?php

declare(strict_types=1);

namespace App\Test\Fixture;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{

    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'is_superuser' => true,
                'username' => 'admin',
                'password' => '$2y$10$BFHwQEm4IkCsW0Uad4O4aehrTBk7Mz5AyVzHwiUrnRooaHfe4AtPy',
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'is_superuser' => false,
                'username' => 'user',
                'password' => '$2y$10$968.SHl9m4XxMdB3Ijx5u.Nm6I7JIBMjyidZtlyQizCxRp0IJGHx.',
                'role' => 'user',
            ],
        ];

        foreach ($this->records as $key => $value) {
            $this->records[$key]['password'] = (new DefaultPasswordHasher())->hash('123');
        }

        parent::init();
    }
}
