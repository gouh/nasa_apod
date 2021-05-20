<?php

declare(strict_types=1);

namespace App\Handler;

use App\Document\Apod;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Persistence\ObjectRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use PsrHealth\Health;
use StructuredHandlers\JsonResponse;

class HealthHandler implements RequestHandlerInterface
{
    /**
     * @var DocumentManager
     */
    public $odm;

    /**
     * @var ObjectRepository
     */
    public $repository;

    /**
     * @var Health
     */
    public $health;

    public function __construct(DocumentManager $odm, Health $health)
    {
        $this->odm = $odm;
        $this->health = $health;
        $this->repository = $this->odm->getRepository(Apod::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse($this->health->getHealthStatus());
    }
}
