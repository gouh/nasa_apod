<?php

declare(strict_types=1);

namespace App\Factory;

use App\DAO\ApodDao;
use App\Service\ApodService;
use Psr\Container\ContainerInterface;

class ApodServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return ApodService
     */
    public function __invoke(ContainerInterface $container): ApodService
    {
        $apodDao = $container->get(ApodDao::class);
        return new ApodService($apodDao);
    }
}