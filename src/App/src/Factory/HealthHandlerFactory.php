<?php

declare(strict_types=1);

namespace App\Factory;

use App\Handler\HealthHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use PsrHealth\Health;

class HealthHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $health = $container->get(Health::class);
        return new HealthHandler($health);
    }
}