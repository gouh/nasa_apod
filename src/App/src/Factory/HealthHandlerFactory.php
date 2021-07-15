<?php

declare(strict_types=1);

namespace App\Factory;

use App\Handler\HealthHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Catcoderphp\CustomConfigProvider\Service\Health\EndpointConnectionService;
use Catcoderphp\CustomConfigProvider\Service\Health\MongoConnectionService;
use Catcoderphp\CustomConfigProvider\Service\Health\RedisConnectionService;
use Catcoderphp\CustomConfigProvider\Service\Health\SqlConnectionService;

class HealthHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $sql = $container->get(SqlConnectionService::class);
        $mongo = $container->get(MongoConnectionService::class);
        $redis = $container->get(RedisConnectionService::class);
        $endPoint = $container->get(EndpointConnectionService::class);
        return new HealthHandler($sql, $mongo, $redis, $endPoint);
    }
}