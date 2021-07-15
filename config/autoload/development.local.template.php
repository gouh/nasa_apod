<?php

/**
 * Development-only configuration.
 *
 * Put settings you want enabled when under development mode in this file, and
 * check it into your repository.
 *
 * Developers on your team will then automatically enable them by calling on
 * `composer development-enable`.
 */

declare(strict_types=1);

use Laminas\Cache\Storage\Adapter\Redis;
use Mezzio\Container;
use Mezzio\Middleware\ErrorResponseGenerator;

return [
    'dependencies' => [
        'factories' => [
            ErrorResponseGenerator::class => Container\WhoopsErrorResponseGeneratorFactory::class,
            'Mezzio\Whoops'               => Container\WhoopsFactory::class,
            'Mezzio\WhoopsPageHandler'    => Container\WhoopsPageHandlerFactory::class,
        ],
    ],
    'whoops'       => [
        'json_exceptions' => [
            'display'    => true,
            'show_trace' => true,
            'ajax_only'  => true,
        ],
    ],

    # Config Sql
    'db' => [
        'hostname' => 'local-mysql-57',
        'database' => 'claroplus',
        'port' => '3306',
        'driver' => 'Pdo_Mysql',
        'username' => 'root',
        'password' => 'secret'
    ],

    # Config Cache Db
    'caches' => [
        Redis::class => [
            'adapter' => [
            'name' => Redis::class,
                'options' => [
                    'ttl' => 1,
                    'server' => [
                        'host' => getenv('USERVAR_REDIS_HOST'),
                        'port' => getenv('USERVAR_REDIS_PORT')
                    ],
                    'password' => getenv('USERVAR_REDIS_PASSWORD')
                ]
            ]
        ]
    ],

    # Config Mongo DB
    'mongo' => [
        'server' => getenv('USERVAR_MONGO_HOST'),
        'port' => getenv('USERVAR_MONGO_PORT'),
        'connectionString' => getenv('USERVAR_MONGO_URI'),
        'user' => getenv('USERVAR_MONGO_USERNAME'),
        'password' => getenv('USERVAR_MONGO_PASSWORD'),
        'dbname' => getenv('USERVAR_MONGO_DB')
    ]
];
