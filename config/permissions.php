<?php

use CakeDC\Auth\Rbac\Rules\Owner;

return [
    'CakeDC/Auth.permissions' => [
        [
            'role' => '*',
            'controller' => 'Users',
            'action' => ['add', 'login', 'logout'],
            'bypassAuth' => true
        ],
        [
            'role' => 'user',
            'controller' => 'Posts',
            'action' => ['index', 'view', 'add']
        ],
        [
            'role' => 'user',
            'controller' => 'Posts',
            'action' => ['edit', 'delete'],
            'allowed' => new Owner(['ownerForeignKey' => 'another_user_id'])
        ],
        [
            'role' => 'admin',
            'controller' => '*',
            'action' => '*'
        ]
    ]
];
