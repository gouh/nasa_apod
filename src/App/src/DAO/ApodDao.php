<?php

declare(strict_types=1);

namespace App\DAO;

use App\Document\Apod;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Iterator\Iterator;
use Doctrine\ODM\MongoDB\MongoDBException;
use InvalidArgumentException;
use MongoDB\DeleteResult;
use MongoDB\InsertOneResult;
use MongoDB\UpdateResult;

class ApodDao
{
    /**
     * @var DocumentManager
     */
    public $documentManager;

    public $repository;

    /**
     * ApodDto constructor.
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
        $this->repository = $this->documentManager->getRepository(Apod::class);
    }

    /**
     * Finds all APODs.
     *
     * @return array
     * @throws MongoDBException
     */
    public function getAll(): array
    {
        return $this->documentManager
            ->createQueryBuilder(Apod::class)
            ->find()
            ->field('status')->equals(true)
            ->getQuery()
            ->execute()
            ->toArray();
    }

    /**
     * Finds an APOD by its primary key / identifier.
     *
     * @param string $apodId
     * @return object|null
     */
    public function get(string $apodId): ?object
    {
        return $this->documentManager
            ->createQueryBuilder(Apod::class)
            ->find()
            ->field('id')->equals($apodId)
            ->field('status')->equals(true)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param Apod $apod
     * @return Apod
     * @throws InvalidArgumentException|MongoDBException
     */
    public function save(Apod $apod): Apod
    {
        $this->documentManager->persist($apod);
        $this->documentManager->flush();
        return $apod;
    }

    /**
     * @param string $apodId
     * @param Apod $apod
     * @return array|Iterator|int|DeleteResult|InsertOneResult|UpdateResult|object|null
     * @throws MongoDBException
     */
    public function update(string $apodId, Apod $apod)
    {
        return $this->documentManager
            ->createQueryBuilder(Apod::class)
            ->findAndUpdate()
            ->returnNew()
            ->field('id')->equals($apodId)
            ->field('status')->equals(true)
            ->field('date')->set($apod->getDate())
            ->field('explanation')->set($apod->getExplanation())
            ->field('hdurl')->set($apod->getHdurl())
            ->field('mediaType')->set($apod->getMediaType())
            ->field('serviceVersion')->set($apod->getServiceVersion())
            ->field('title')->set($apod->getTitle())
            ->field('url')->set($apod->getUrl())
            ->getQuery()
            ->execute();
    }

    /**
     * @param string $apodId
     * @return array|Iterator|int|DeleteResult|InsertOneResult|UpdateResult|object|null
     * @throws MongoDBException
     */
    public function delete(string $apodId)
    {
        return $this->documentManager
            ->createQueryBuilder(Apod::class)
            ->findAndUpdate()
            ->returnNew()
            ->field('id')->equals($apodId)
            ->field('status')->equals(true)
            ->field('status')->set(false)
            ->getQuery()
            ->execute();
    }
}