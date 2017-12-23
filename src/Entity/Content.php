<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 * @ORM\Table(name="content")
 * @ORM\HasLifecycleCallbacks()
 */
class Content
{

    use Timestampable;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65)
     */
    private $status;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean",options={"default"=true})
     */
    private $isPublished;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="deleted_at", nullable=true)
     */
    private $deletedAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Content
     */
    public function setId( $id )
    {
        $this->id = $id;
        return $this;
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
     * @return Content
     */
    public function setTitle( string $title ): Content
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return Content
     */
    public function setSummary( string $summary ): Content
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Content
     */
    public function setBody( string $body ): Content
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Content
     */
    public function setStatus( string $status ): Content
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool $isPublished
     * @return Content
     */
    public function setIsPublished( bool $isPublished ): Content
    {
        $this->isPublished = $isPublished;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Content
     */
    public function setCreatedAt( \DateTime $createdAt ): Content
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Content
     */
    public function setUpdatedAt( \DateTime $updatedAt ): Content
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt(): \DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     * @return Content
     */
    public function setDeletedAt( \DateTime $deletedAt ): Content
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Content
     */
    public function setPath( string $path ): Content
    {
        $this->path = $path;
        return $this;
    }


}
