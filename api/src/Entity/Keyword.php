<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\KeywordRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: KeywordRepository::class)]
#[ApiResource]
class Keyword
{

    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'keywords')]
    private ?Offer $offer = null;

    #[ORM\ManyToOne(inversedBy: 'keywords')]
    private ?Freelance $freelance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getFreelance(): ?Freelance
    {
        return $this->freelance;
    }

    public function setFreelance(?Freelance $freelance): self
    {
        $this->freelance = $freelance;

        return $this;
    }
}
