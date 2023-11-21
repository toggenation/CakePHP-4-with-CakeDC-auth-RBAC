<?php

declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostsFixture
 */
class PostsFixture extends TestFixture
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
                'body' => 'Admin User Body 1',
                'title' => 'Admin User Title 1',
                'user_id' => 1,
                'created' => '2023-11-17 22:43:52',
                'modified' => null,
            ],
            [
                'id' => 2,
                'body' => 'User Body 2',
                'title' => 'User Title 1',
                'user_id' => 2,
                'created' => '2023-11-17 22:43:52',
                'modified' => null,
            ],
            [
                'id' => 3,
                'body' => 'Admin User Body 2',
                'title' => 'Admin User Title 2',
                'user_id' => 1,
                'created' => '2023-11-17 22:43:52',
                'modified' => null,
            ],
            [
                'id' => 4,
                'body' => 'User Body 2',
                'title' => 'User Title 2',
                'user_id' => 2,
                'created' => '2023-11-17 22:43:52',
                'modified' => null,
            ],
        ];
        parent::init();
    }
}
