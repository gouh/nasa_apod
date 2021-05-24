<?php

declare(strict_types=1);

namespace App\Service;

use App\DAO\ApodDao;
use App\Document\Apod;
use App\DTO\ApodDto;
use Doctrine\ODM\MongoDB\MongoDBException;
use Exception;
use Fig\Http\Message\StatusCodeInterface;

class ApodService
{
    private const APOD_NOT_FOUND = 'The specified APOD was not found';

    /**
     * @var ApodDao
     */
    public $apodDao;

    public function __construct(ApodDao $apod)
    {
        $this->apodDao = $apod;
    }

    /**
     * @param ApodDto $apodDto
     * @return Apod
     */
    private function apodFromDto(ApodDto $apodDto): Apod
    {
        $apod = new Apod();
        $apod->setDate($apodDto->date);
        $apod->setExplanation($apodDto->date);
        $apod->setHdurl($apodDto->hdurl);
        $apod->setHdurl($apodDto->explanation);
        $apod->setMediaType($apodDto->mediaType);
        $apod->setServiceVersion($apodDto->serviceVersion);
        $apod->setTitle($apodDto->title);
        $apod->setUrl($apodDto->url);
        return $apod;
    }

    /**
     * @param int $page
     * @param int $itemsPerPage
     * @return array
     * @throws Exception
     */
    public function getAll(int $page, int $itemsPerPage): array
    {
        try {
            $apods = $this->apodDao->getAll($page, $itemsPerPage);
            $apods['items'] = ApodDto::arrayFromDb($apods['items']);
            return $apods;
        }catch (Exception $e) {
            throw new Exception($e->getMessage(), StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param string $apodId
     * @return ApodDto
     * @throws Exception
     */
    public function get(string $apodId): ApodDto
    {
        $apod = $this->apodDao->get($apodId);

        if ($apod === NULL) {
            throw new Exception(self::APOD_NOT_FOUND, StatusCodeInterface::STATUS_NOT_FOUND);
        }

        return ApodDto::objectFromDb($apod);
    }

    /**
     * @param ApodDto $apodDto
     * @return ApodDto
     * @throws Exception
     */
    public function save(ApodDto $apodDto): ApodDto
    {
        $apod = $this->apodFromDto($apodDto);

        try {
            $apod = $this->apodDao->save($apod);
        } catch (MongoDBException $e) {
            throw new Exception($e->getMessage(), StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        return ApodDto::objectFromDb($apod);
    }

    /**
     * @param string $apodId
     * @param ApodDto $apodDto
     * @return ApodDto
     * @throws Exception
     */
    public function update(string $apodId, ApodDto $apodDto): ApodDto
    {
        $apod = $this->apodFromDto($apodDto);

        try {
            $apod = $this->apodDao->update($apodId, $apod);
            if ($apod == NULL) {
                throw new Exception(self::APOD_NOT_FOUND, StatusCodeInterface::STATUS_NOT_FOUND);
            }
        } catch (MongoDBException $e) {
            throw new Exception($e->getMessage(), StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        return ApodDto::objectFromDb($apod);
    }

    /**
     * @param string $apodId
     * @return ApodDto
     * @throws Exception
     */
    public function delete(string $apodId): ApodDto
    {
        try {
            $apod = $this->apodDao->delete($apodId);
            if ($apod == NULL) {
                throw new Exception(self::APOD_NOT_FOUND, StatusCodeInterface::STATUS_NOT_FOUND);
            }
        } catch (MongoDBException $e) {
            throw new Exception($e->getMessage(), StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        return ApodDto::objectFromDb($apod);
    }
}