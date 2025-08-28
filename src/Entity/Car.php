<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Brand $Brand_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $circulationAt = null;

    #[ORM\Column]
    private ?int $DoorsNumber = null;

    #[ORM\Column]
    private ?bool $isElectric = null;

    #[ORM\Column(length: 255)]
    private ?string $imgCar = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandId(): ?Brand
    {
        return $this->Brand_id;
    }

    public function setBrandId(?Brand $Brand_id): static
    {
        $this->Brand_id = $Brand_id;

        return $this;
    }

    public function getCirculationAt(): ?\DateTimeImmutable
    {
        return $this->circulationAt;
    }

    public function setCirculationAt(\DateTimeImmutable $circulationAt): static
    {
        $this->circulationAt = $circulationAt;

        return $this;
    }

    public function getDoorsNumber(): ?int
    {
        return $this->DoorsNumber;
    }

    public function setDoorsNumber(int $DoorsNumber): static
    {
        $this->DoorsNumber = $DoorsNumber;

        return $this;
    }

    public function isElectric(): ?bool
    {
        return $this->isElectric;
    }

    public function setIsElectric(bool $isElectric): static
    {
        $this->isElectric = $isElectric;

        return $this;
    }

    public function getImgCar(): ?string
    {
        return $this->imgCar;
    }

    public function setImgCar(string $imgCar): static
    {
        $this->imgCar = $imgCar;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
