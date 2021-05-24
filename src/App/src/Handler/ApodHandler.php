<?php

declare(strict_types=1);

namespace App\Handler;

use App\DTO\ApodDto;
use App\Service\ApodService;
use Exception;
use Laminas\InputFilter\InputFilterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use StructuredHandlers\JsonResponse;

class ApodHandler implements RequestHandlerInterface
{
    /**
     * @var ApodService
     */
    public $apodService;

    /**
     * @var InputFilterInterface
     */
    public $inputFilter;

    public function __construct(ApodService $apodService, InputFilterInterface $inputFilter)
    {
        $this->apodService = $apodService;
        $this->inputFilter = $inputFilter;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $method = strtolower($request->getMethod());
        return $this->$method($request);
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $apodId = $request->getAttribute('apodId');

        try {
            if ($apodId) {
                $apod = $this->apodService->get($apodId);
                return new JsonResponse($apod->toArray(), 'Apod');
            }

            $page = $request->getAttribute('page');
            $page = $page ? (int) $page : 1;
            $itemsPerPage = $request->getAttribute('itemsPerPage');
            $itemsPerPage = $itemsPerPage ? (int) $itemsPerPage : 10;

            $apods = $this->apodService->getAll($page, $itemsPerPage);
            $response = new JsonResponse($apods['items'], 'List of APOD\'s');
            return $response
                ->buildWithPagination(
                    $apods['current_page'],
                    $apods['items_per_page'],
                    $apods['total_items'],
                    $apods['total_pages']
                );
        } catch (Exception $e) {
            return new JsonResponse([], $e->getMessage(), $e->getCode());
        }
    }

    public function post(ServerRequestInterface $request): ResponseInterface
    {
        $this->inputFilter->setData($request->getParsedBody());
        if (!$this->inputFilter->isValid()) {
            return new JsonResponse($this->inputFilter->getMessages(), '', 400);
        }

        $filteredParams = $this->inputFilter->getValues();
        $apodDto = ApodDto::fromArray($filteredParams);

        try {
            $apod = $this->apodService->save($apodDto);
            return new JsonResponse($apod->toArray(), 'Apod saved');
        } catch (Exception $e) {
            return new JsonResponse([], $e->getMessage(), $e->getCode());
        }
    }

    public function put(ServerRequestInterface $request): ResponseInterface
    {
        $this->inputFilter->setData($request->getParsedBody());
        if (!$this->inputFilter->isValid()) {
            return new JsonResponse($this->inputFilter->getMessages(), '', 400);
        }

        $filteredParams = $this->inputFilter->getValues();
        $apodId = $request->getAttribute('apodId');
        $apodDto = ApodDto::fromArray($filteredParams);

        try {
            $apod = $this->apodService->update($apodId, $apodDto);
            return new JsonResponse($apod->toArray(), 'Apod updated');
        } catch (Exception $e) {
            return new JsonResponse([], $e->getMessage(), $e->getCode());
        }
    }

    public function delete(ServerRequestInterface $request): ResponseInterface
    {
        $apodId = $request->getAttribute('apodId');

        try {
            $apod = $this->apodService->delete($apodId);
            return new JsonResponse($apod->toArray(), 'Apod deleted');
        } catch (Exception $e) {
            return new JsonResponse([], $e->getMessage(), $e->getCode());
        }
    }

}