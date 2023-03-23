<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Posts seed.
 */
class PostsSeed extends AbstractSeed
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
    public function run(): void
    {
        $data = [
            [
                'title' => 'Admin User Title 1',
                'body' => 'Admin User Body 1',
                'user_id' => 1
            ],
            [
                'title' => 'User Title 1',
                'body' => 'User Body 2',
                'user_id' => 2
            ],
            [
                'title' => 'Admin User Title 2',
                'body' => 'Admin User Body 2',
                'user_id' => 1
            ],

            [
                'title' => 'User Title 2',
                'body' => 'User Body 2',
                'user_id' => 2
            ]
        ];

        $table = $this->table('posts');

        $table->truncate();

        $table->insert($data)->save();
    }
}
