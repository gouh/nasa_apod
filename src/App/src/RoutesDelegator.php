<?php

namespace App;

use Psr\Container\ContainerInterface;
use Mezzio\Application;

/**
 * Configuración para el delegator de rutas
 *
 * @see https://docs.mezzio.dev/mezzio/v3/features/container/delegator-factories/
 */
class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback): Application
    {
        $app = $callback();

        /**
         * Extras
         */
        $app->route('/', Handler\HealthHandler::class, ['GET'], 'health');

        return $app;
    }
}
