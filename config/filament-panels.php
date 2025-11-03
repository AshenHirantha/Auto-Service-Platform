<?php


return [
    'panels' => [
        'admin' => [
            'id' => 'admin',
            'path' => 'admin',
            'login' => true,
            'registration' => false,
            'auth_guard' => 'web',
        ],
        'customer' => [
            'id' => 'customer',
            'path' => 'customer',
            'login' => true,
            'registration' => true,
            'auth_guard' => 'web',
        ],
        'service-station' => [
            'id' => 'service-station',
            'path' => 'service-station',
            'login' => true,
            'registration' => true,
            'auth_guard' => 'web',
        ],
        'vendor' => [
            'id' => 'vendor',
            'path' => 'vendor',
            'login' => true,
            'registration' => true,
            'auth_guard' => 'web',
        ],
    ],
];
