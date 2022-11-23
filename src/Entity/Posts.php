<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
#[ApiResource]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $title = null;

    #[ORM\Column(length: 750)]
    private ?string $contents = null;

    #[ORM\Column(length: 750, nullable: true)]
    private ?string $contents2 = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $subtitle = null;
    
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?array $imgPost = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?array $imgPost2 = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?array $imgPost3 = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?array $imgPost4 = null;

    #[ORM\Column(length: 500)]
    private ?string $imgThumbnail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContents(): ?string
    {
        return $this->contents;
    }

    public function setContents(string $contents): self
    {
        $this->contents = $contents;

        return $this;
    }

    public function getContents2(): ?string
    {
        return $this->contents2;
    }

    public function setContents2(string $contents2): self
    {
        $this->contents2 = $contents2;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


    public function getImgPost2(): ?array
    {
        return $this->imgPost2;
    }

    public function setImgPost2(?array $imgPost2): void
    {
        $this->imgPost2 = $imgPost2;

    }

    public function getImgPost3(): ?array
    {
        return $this->imgPost3;
    }

    public function setImgPost3(?array $imgPost3): void
    {
        $this->imgPost3 = $imgPost3;
    }

    public function getImgPost4(): ?array
    {
        return $this->imgPost4;
    }

    public function setImgPost4(?array $imgPost4): void
    {
        $this->imgPost4 = $imgPost4;

    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getImgPost(): ?array
    {
        return $this->imgPost;
    }

    public function setImgPost(array $imgPost): void
    {
        $this->imgPost = $imgPost;
    }

    public function getImgThumbnail(): ?string
    {
        return $this->imgThumbnail;
    }

    public function setImgThumbnail(string $imgThumbnail): self
    {
        $this->imgThumbnail = $imgThumbnail;

        return $this;
    }
}
