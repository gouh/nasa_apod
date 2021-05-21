<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(db="nasa", collection="apod")
 */
class Apod
{
    /**
     * @ODM\Id
     */
    private $id;

    /** @ODM\Field(type="string") */
    private $date;

    /** @ODM\Field(type="string") */
    private $explanation;

    /** @ODM\Field(type="string") */
    private $hdurl;

    /** @ODM\Field(type="string", name="media_type") */
    private $mediaType;

    /** @ODM\Field(type="string", name="service_version") */
    private $serviceVersion;

    /** @ODM\Field(type="string") */
    private $title;

    /** @ODM\Field(type="string") */
    private $url;

    /** @ODM\Field(type="boolean") */
    private $status;

    public function __construct()
    {
        $this->status = true;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

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

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}