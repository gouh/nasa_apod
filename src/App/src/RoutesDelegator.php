<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;
use Mezzio\Application;

/**
 * @see https://docs.mezzio.dev/mezzio/v3/features/container/delegator-factories/
 */
class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback): Application
    {
        $app = $callback();

        // Health page
        $app->get('/v1/health', Handler\HealthHandler::class, 'apod.health');

        // Get all apods
        $app->get(
            '/v1/apods[/{page:\d+}[/{itemsPerPage:\d+}]]',
            Handler\ApodHandler::class, 'GET',
            'apod.getAllApod'
        );

        // Get specific apod
        $app->get('/v1/apod/{apodId}', Handler\ApodHandler::class, 'apod.getApod');

        // Add new apod
        $app->post('/v1/apod', Handler\ApodHandler::class, 'apod.newApod');

        // Update apod
        $app->put('/v1/apod/{apodId}', Handler\ApodHandler::class, 'apod.updateApod');

        // Logic delete apod
        $app->delete('/v1/apod/{apodId}', Handler\ApodHandler::class, 'apod.deleteApod');

        return $app;
    }
}
