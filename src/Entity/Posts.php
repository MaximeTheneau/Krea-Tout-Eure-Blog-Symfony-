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

    #[ORM\Column(length: 750)]
    private ?string $contents2 = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgPost2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgPost3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgPost4 = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $subtitle = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $imgPost = null;

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




    public function getImgPost2(): ?string
    {
        return $this->imgPost2;
    }

    public function setImgPost2(?string $imgPost2): self
    {
        $this->imgPost2 = $imgPost2;

        return $this;
    }

    public function getImgPost3(): ?string
    {
        return $this->imgPost3;
    }

    public function setImgPost3(?string $imgPost3): self
    {
        $this->imgPost3 = $imgPost3;

        return $this;
    }

    public function getImgPost4(): ?string
    {
        return $this->imgPost4;
    }

    public function setImgPost4(?string $imgPost4): self
    {
        $this->imgPost4 = $imgPost4;

        return $this;
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

    public function getImgPost(): ?string
    {
        return $this->imgPost;
    }

    public function setImgPost(string $imgPost): self
    {
        $this->imgPost = $imgPost;

        return $this;
    }
}
