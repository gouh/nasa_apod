<?php

declare(strict_types=1);

namespace App;

use Mezzio\Application;

/**use App\Service\MembershipServiceFactory;
 * Proveedor de configuración para el modulo app de claro plus
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'input_filters' => $this->getInputFilters()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [
                    RoutesDelegator::class
                ]
            ],
            'factories' => [
                Handler\HealthHandler::class => Factory\HealthHandlerFactory::class,
                Handler\ApodHandler::class => Factory\ApodHanlderFactory::class,
                DAO\ApodDao::class => Factory\ApodDaoFactory::class,
                Service\ApodService::class => Factory\ApodServiceFactory::class
            ]
        ];
    }

    public function getInputFilters() : array
    {
        return [
            'invokables' => [
                InputFilter\ApodInputFilter::class => InputFilter\ApodInputFilter::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app' => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout']
            ],
        ];
    }
}
