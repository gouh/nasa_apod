<?php


namespace App\Factory;

use App\Handler\HealthHandler;
use Doctrine\ODM\MongoDB\DocumentManager;
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
        $documentManager = $container->get(DocumentManager::class);
        return new HealthHandler($documentManager, $health);
    }
}