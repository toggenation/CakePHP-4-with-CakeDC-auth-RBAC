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
            'allowed' => new Owner
        ],
        [
            'role' => 'admin',
            'controller' => '*',
            'action' => '*'
        ],

        // [
        //     'role' => 'user',
        //     'controller' => 'Pages',
        //     'action' => 'display',
        //     'allowed' => function ($user, $role, $request) {
        //         // dd([$user, $role, $request->getParam('pass')]);

        //         if ($request->getParam('pass')[0] === 'home') {
        //             return true;
        //         }
        //         return false;
        //     }
        // ]
        [
            'role' => 'user',
            'controller' => 'Pages',
            'action' => 'display',
        ]
    ]
];
