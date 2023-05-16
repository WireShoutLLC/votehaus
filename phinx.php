<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'pgsql',
            'host' => parse_url(getenv('DATABASE_URL'), PHP_URL_HOST),
            'name' => ltrim(parse_url(getenv('DATABASE_URL'), PHP_URL_PATH), '/'),
            'user' => parse_url(getenv('DATABASE_URL'), PHP_URL_USER),
            'pass' => parse_url(getenv('DATABASE_URL'), PHP_URL_PASS),
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'pgsql',
            'host' => 'localhost',
            'name' => 'votehaus',
            'user' => 'votehaus',
            'pass' => 'password',
            'port' => '5432',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'pgsql',
            'host' => 'localhost',
            'name' => 'votehaus',
            'user' => 'votehaus',
            'pass' => 'password',
            'port' => '5432',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];