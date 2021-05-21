<?php


namespace App\Factory;


use App\DAO\ApodDao;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Container\ContainerInterface;

class ApodDaoFactory
{
    /**
     * @param ContainerInterface $container
     * @return ApodDao
     */
    public function __invoke(ContainerInterface $container): ApodDao
    {
        $documentManager = $container->get(DocumentManager::class);
        return new ApodDao($documentManager);
    }
}