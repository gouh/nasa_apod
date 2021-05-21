<?php

declare(strict_types=1);

namespace App\DTO;

use StructuredHandlers\DataTransferObject;

class ApodDto extends DataTransferObject
{
    public $id;
    public $date;
    public $explanation;
    public $hdurl;
    public $mediaType;
    public $serviceVersion;
    public $title;
    public $url;
    public $status;

    /**
     * @param object $object
     * @return static
     */
    public static function objectFromDb(object $object): self
    {
        return new self([
            'id' => $object->getId(),
            'date' => $object->getDate(),
            'explanation' => $object->getExplanation(),
            'hdurl' => $object->getHdurl(),
            'mediaType' => $object->getMediaType(),
            'serviceVersion' => $object->getServiceVersion(),
            'title' => $object->getTitle(),
            'url' => $object->getUrl(),
            'status' => $object->isStatus()
        ]);
    }

    /**
     * @param array $objects
     * @return array
     */
    public static function arrayFromDb(array $objects): array
    {
        $apodDtos = [];
        foreach ($objects as $object) {
            $apodDtos[] = self::objectFromDb($object)->toArray();
        }
        return $apodDtos;
    }
}