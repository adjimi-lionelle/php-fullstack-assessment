<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"brand_id")]
    private ?int $brandId = null;

    #[ORM\Column(length: 255)]
    private ?string $brandName = null;

    #[ORM\Column(length: 255)]
    private ?string $brandImage = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(type: Types::JSON)]
    private array $targetCountries = [];

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct(){
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->brandId;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function setBrandName(string $brandName): static
    {
        $this->brandName = $brandName;

        return $this;
    }

    public function getBrandImage(): ?string
    {
        return $this->brandImage;
    }

    public function setBrandImage(string $brandImage): static
    {
        $this->brandImage = $brandImage;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getTargetCountries(): array
    {
        return $this->targetCountries;
    }

    public function setTargetCountries(array $targetCountries): static
    {
        $this->targetCountries = $targetCountries;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
