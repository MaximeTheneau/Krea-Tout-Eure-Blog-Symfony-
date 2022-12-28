<?php

namespace App\Entity;

use App\Repository\ImagePlaceholderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImagePlaceholderRepository::class)]
#[ApiResource]
class ImagePlaceholder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['api_placeholder_browse'])]
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
