<?php

return [

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'agents',
        ],
    ],

    'providers' => [
        'agents' => [
            'driver' => 'eloquent',
            'model' => Paparadi\Papaadmin\Models\Agent::class,
        ],
    ],

    'passwords' => [
        'agents' => [
            'provider' => 'agents',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
