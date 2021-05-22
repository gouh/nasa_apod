<?php

declare(strict_types=1);

namespace App\Factory;

use App\Handler\ApodHandler;
use App\InputFilter\ApodInputFilter;
use App\Service\ApodService;
use Laminas\InputFilter\InputFilterPluginManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ApodHanlderFactory
{
    /**
     * @param ContainerInterface $container
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        /** @var InputFilterPluginManager $pluginManager */
        $pluginManager = $container->get(InputFilterPluginManager::class);
        $inputFilter   = $pluginManager->get(ApodInputFilter::class);
        $apodService = $container->get(ApodService::class);
        return new ApodHandler($apodService, $inputFilter);
    }
}