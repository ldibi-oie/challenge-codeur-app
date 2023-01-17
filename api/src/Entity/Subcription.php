<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubcriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubcriptionRepository::class)]
#[ApiResource]
class Subcription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $subcriptiontype = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubcriptiontype(): ?string
    {
        return $this->subcriptiontype;
    }

    public function setSubcriptiontype(string $subcriptiontype): self
    {
        $this->subcriptiontype = $subcriptiontype;

        return $this;
    }
}
