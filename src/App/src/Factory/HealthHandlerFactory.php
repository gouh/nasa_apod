<?php


namespace App\Factory;

use App\Handler\HealthHandler;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HealthHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new HealthHandler($container->get(DocumentManager::class));
    }
}