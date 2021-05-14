<?php

namespace DoctrineOdm;

use Doctrine\ODM\MongoDB\DocumentManager;
use DoctrineModule\Service as CommonService;
use DoctrineMongoODMModule\Service as ODMService;

class ConfigProvider
{
    /**
     * Return configuration for this component.
     *
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
        ];
    }

    /**
     * Return dependency mappings for this component.
     *
     * @return array
     */
    public function getDependencyConfig(): array
    {
        return [
            'aliases' => [
                DocumentManager::class => 'doctrine.documentmanager.odm_default'
            ],
            'factories' => [
                // @codingStandardsIgnoreStart
                'doctrine.authenticationadapter.odm_default'  => new CommonService\Authentication\AdapterFactory('odm_default'),
                'doctrine.authenticationstorage.odm_default'  => new CommonService\Authentication\StorageFactory('odm_default'),
                'doctrine.authenticationservice.odm_default'  => new CommonService\Authentication\AuthenticationServiceFactory('odm_default'),
                'doctrine.connection.odm_default'             => new ODMService\ConnectionFactory('odm_default'),
                'doctrine.configuration.odm_default'          => new ODMService\ConfigurationFactory('odm_default'),
                'doctrine.driver.odm_default'                 => new CommonService\DriverFactory('odm_default'),
                'doctrine.documentmanager.odm_default'        => new ODMService\DocumentManagerFactory('odm_default'),
                'doctrine.eventmanager.odm_default'           => new CommonService\EventManagerFactory('odm_default'),
                'doctrine.mongo_logger_collector.odm_default' => new ODMService\MongoLoggerCollectorFactory('odm_default'),
                // @codingStandardsIgnoreEnd
            ],
        ];
    }
}
