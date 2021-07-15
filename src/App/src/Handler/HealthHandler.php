<?php

declare(strict_types=1);

namespace App\Handler;

use Catcoderphp\CustomConfigProvider\Service\Health\EndpointConnectionService;
use Catcoderphp\CustomConfigProvider\Service\Health\MongoConnectionService;
use Catcoderphp\CustomConfigProvider\Service\Health\RedisConnectionService;
use Catcoderphp\CustomConfigProvider\Service\Health\SqlConnectionService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use StructuredHandlers\JsonResponse;

class HealthHandler implements RequestHandlerInterface
{
    /**
     * @var SqlConnectionService
     */
    public $sql;
    public $mongo;
    public $redis;
    public $endpoint;

    public function __construct(
        SqlConnectionService $sql,
        MongoConnectionService $mongo,
        RedisConnectionService $redis,
        EndpointConnectionService $endpoint
    )
    {
        $this->sql = $sql;
        $this->mongo = $mongo;
        $this->redis = $redis;
        $this->endpoint = $endpoint;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            'sqlAdapter' => $this->sql->checkConnection(),
            'mongoAdapter' => $this->mongo->checkConnection(),
            'redisAdapter' => $this->redis->checkConnection(),
            'endpointAdapter' => $this->endpoint->checkConnection('https://hangouh.me')
        ]);
    }
}
