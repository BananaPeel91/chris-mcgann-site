<?php

/**
 * Database configuration - Not used in this application
 * The site uses file-based caching only, no database required
 */

return [

    'default' => env('DB_CONNECTION', 'sqlite'),

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ],
    ],

    'migrations' => 'migrations',

];
