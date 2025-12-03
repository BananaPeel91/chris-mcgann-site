<?php

/**
 * Database configuration
 * Using SQLite for simple settings storage (Instagram token)
 */

return [

    'default' => env('DB_CONNECTION', 'sqlite'),

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
    ],

    'migrations' => 'migrations',

];
