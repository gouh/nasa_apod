<?php

declare(strict_types=1);

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
         * Health
         */
        $app->route('/v1/health', Handler\HealthHandler::class, ['GET'], 'apod.health');

        /**
         * get
         */
        $app->route('/v1/apod', Handler\ApodHandler::class, ['GET'], 'apod.getAllApod');
        $app->route('/v1/apod/{apodId}', Handler\ApodHandler::class, ['GET'], 'apod.getApod');
        $app->route('/v1/apod', Handler\ApodHandler::class, ['POST'], 'apod.newApod');
        $app->route('/v1/apod/{apodId}', Handler\ApodHandler::class, ['PUT'], 'apod.updateApod');
        $app->route('/v1/apod/{apodId}', Handler\ApodHandler::class, ['DELETE'], 'apod.deleteApod');

        return $app;
    }
}
