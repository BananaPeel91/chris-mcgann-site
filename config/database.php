<?php

/**
 * Database configuration
 * - PostgreSQL on Railway (via DATABASE_URL)
 * - SQLite for local development
 */

// Parse DATABASE_URL if available (Railway provides this)
$databaseUrl = env('DATABASE_URL');
$pgConnection = [];

if ($databaseUrl) {
    $url = parse_url($databaseUrl);
    $pgConnection = [
        'driver' => 'pgsql',
        'host' => $url['host'] ?? 'localhost',
        'port' => $url['port'] ?? 5432,
        'database' => ltrim($url['path'] ?? '', '/'),
        'username' => $url['user'] ?? '',
        'password' => $url['pass'] ?? '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'require',
    ];
}

return [

    'default' => env('DB_CONNECTION', $databaseUrl ? 'pgsql' : 'sqlite'),

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        
        'pgsql' => $pgConnection ?: [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 5432),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', ''),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
    ],

    'migrations' => 'migrations',

];
