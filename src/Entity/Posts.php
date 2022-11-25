<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
#[ApiResource(
)]
class Posts
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_posts_browse', 'api_posts_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    #[Groups(['api_posts_browse', 'api_posts_read', 'api_posts_thumbnail'])]
    private ?string $title = null;

    #[ORM\Column(length: 750, nullable: true)]
    #[Groups(['api_posts_read'])]
    private ?string $contents = null;

    #[ORM\Column(length: 750, nullable: true)]
    #[Groups(['api_posts_read'])]
    private ?string $contents2 = null;

    #[ORM\Column(length: 70, nullable: true)]
    #[Groups(['api_posts_read'])]
    private ?string $subtitle = null;
    
    #[ORM\Column(length: 255)]
    #[Groups(['api_posts_browse', 'api_posts_read', 'api_posts_thumbnail'])]
    private ?string $slug = null;

    #[ORM\Column]
    #[Groups(['api_posts_read'])]
    private ?array $imgPost =[];

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['api_posts_read'])]
    private ?array $imgPost2 = null;

    #[Groups(['api_posts_read'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?array $imgPost3 = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['api_posts_read'])]
    private ?array $imgPost4 = null;

    #[ORM\Column(length: 500)]
    #[Groups(['api_posts_thumbnail', 'api_posts_browse'])]
    private ?string $imgThumbnail = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updatedAt = null;


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

    public function getImgPost(): ?array
    {
        $imgPost = $this->imgPost;

        return $imgPost;
    }

    public function setImgPost(array $imgPost): self
    {
        $this->imgPost = $imgPost;

        return $this;
    }

    public function getImgPost2(): ?array
    {
        return $this->imgPost2;
    }

    public function setImgPost2(?array $imgPost2): self
    {
        $this->imgPost2 = $imgPost2;

        return $this;

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

    public function setSubtitle(?string $subtitle): void
    {
        $this->subtitle = $subtitle;

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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
