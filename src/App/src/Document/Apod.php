<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(db="nasa", collection="apod")
 */
class Apod
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    public $date;

    /** @ODM\Field(type="string") */
    public $explanation;

    /** @ODM\Field(type="string") */
    public $hdurl;

    /** @ODM\Field(type="string", name="media_type") */
    public $mediaType;

    /** @ODM\Field(type="string", name="service_version") */
    public $serviceVersion;

    /** @ODM\Field(type="string") */
    public $title;

    /** @ODM\Field(type="string") */
    public $url;

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * @param string $explanation
     */
    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }

    /**
     * @return string
     */
    public function getHdurl(): string
    {
        return $this->hdurl;
    }

    /**
     * @param string $hdurl
     */
    public function setHdurl(string $hdurl): void
    {
        $this->hdurl = $hdurl;
    }

    /**
     * @return string
     */
    public function getMediaType(): string
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     */
    public function setMediaType(string $mediaType): void
    {
        $this->mediaType = $mediaType;
    }

    /**
     * @return string
     */
    public function getServiceVersion(): string
    {
        return $this->serviceVersion;
    }

    /**
     * @param string $serviceVersion
     */
    public function setServiceVersion(string $serviceVersion): void
    {
        $this->serviceVersion = $serviceVersion;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}