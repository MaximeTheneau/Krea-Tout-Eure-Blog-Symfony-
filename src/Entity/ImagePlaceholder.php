<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImagePlaceholderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagePlaceholderRepository::class)]
#[ApiResource]
class ImagePlaceholder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $imgBase64 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImgBase64(): ?string
    {
        return $this->imgBase64;
    }

    public function setImgBase64(string $imgBase64): self
    {
        $this->imgBase64 = $imgBase64;

        return $this;
    }
}
