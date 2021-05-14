<?php

declare(strict_types=1);

namespace App\Handler;

use App\Document\Apod;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Persistence\ObjectRepository;
use Laminas\Diactoros\Response\JsonResponse;
use MongoDB\Driver\Exception\Exception;
use MongoDB\Driver\Exception\InvalidArgumentException;
use MongoDB\Driver\Exception\RuntimeException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Redis;
use function time;

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


    public function __construct(DocumentManager $odm)
    {
        $this->odm = $odm;
        $this->repository = $this->odm->getRepository(Apod::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            'time' => time(),
            'php' => phpversion(),
            'mongo' => $this->repository->findAll()
        ]);
    }
}
