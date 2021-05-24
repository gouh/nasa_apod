<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use PsrHealth\Health;
use StructuredHandlers\JsonResponse;

class HealthHandler implements RequestHandlerInterface
{
    /**
     * @var Health
     */
    public $health;

    public function __construct(Health $health)
    {
        $this->health = $health;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse($this->health->getHealthStatus());
    }
}
