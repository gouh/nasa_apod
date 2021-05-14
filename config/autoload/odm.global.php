<?php

declare(strict_types=1);

use Doctrine\ODM\MongoDB\Configuration;
use DoctrineMongoODMModule\Service\DoctrineObjectHydratorFactory;

return [
    'doctrine' => [
        'connection' => [
            'odm_default' => [
                'server'           => getenv('USERVAR_MONGO_HOST'),
                'port'             => getenv('USERVAR_MONGO_PORT'),
                'connectionString' => getenv('USERVAR_MONGO_URI'),
                'user'             => getenv('USERVAR_MONGO_USERNAME'),
                'password'         => getenv('USERVAR_MONGO_PASSWORD'),
                'dbname'           => getenv('USERVAR_MONGO_DB'),
                'options'          => [],
            ],
        ],

        'configuration' => [
            'odm_default' => [
                'metadata_cache'     => 'array',

                'driver'             => 'odm_default',

                'generate_proxies'   => Configuration::AUTOGENERATE_FILE_NOT_EXISTS,
                'proxy_dir'          => '/var/cache/php-fpm/DoctrineMongoODMModule/Proxy',
                'proxy_namespace'    => 'DoctrineMongoODMModule\Proxy',

                'generate_hydrators' => Configuration::AUTOGENERATE_ALWAYS,
                'hydrator_dir'       => '/var/cache/php-fpm/DoctrineMongoODMModule/Hydrator',
                'hydrator_namespace' => 'DoctrineMongoODMModule\Hydrator',

                'generate_persistent_collections' => Configuration::AUTOGENERATE_ALWAYS,
                'persistent_collection_dir' => '/var/cache/php-fpm/DoctrineMongoODMModule/PersistentCollection',
                'persistent_collection_namespace' => 'DoctrineMongoODMModule\PersistentCollection',
                'persistent_collection_factory' => null,
                'persistent_collection_generator' => null,

                'default_db'         => 'apod',

                'filters'            => [],  // array('filterName' => 'BSON\Filter\Class')

                // custom types
                'types'              => [],

                //'classMetadataFactoryName' => 'ClassName'
            ],
        ],

        'driver' => [
            'odm_default' => [
                'class'   => Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::class,
                'drivers' => [
                    __NAMESPACE__ . '\Document' => 'odm_driver'
                ]
            ]
        ],

        'documentmanager' => [
            'odm_default' => [
                'connection'    => 'odm_default',
                'configuration' => 'odm_default',
                'eventmanager' => 'odm_default',
            ],
        ],

        'eventmanager' => [
            'odm_default' => [
                'subscribers' => [],
            ],
        ]
    ],

    'hydrators' => [
        'factories' => [
            'Doctrine\Laminas\Hydrator\DoctrineObject' => DoctrineObjectHydratorFactory::class,
        ],
    ],

];
