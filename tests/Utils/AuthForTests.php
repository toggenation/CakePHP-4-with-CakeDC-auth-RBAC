<?php

namespace App\Test\Utils;

use Cake\ORM\Locator\LocatorAwareTrait;

trait AuthForTests
{
    use LocatorAwareTrait;

    public function authenticateUser($userName = null)
    {
        if (is_null($userName)) {
            $userName = 'admin';
        }

        /**
         * @var \App\Model\Table\UsersTable
         */
        $users = $this->getTableLocator()->get("Users");

        /**
         * @var \App\Model\Entity\User
         */
        $user = $users->find()
            ->where(['username' => $userName])
            ->firstOrFail();

        $this->session(['Auth' => $user]);
    }
}
