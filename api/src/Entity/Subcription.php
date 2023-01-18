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

    #[ORM\OneToOne(mappedBy: 'subscription', cascade: ['persist', 'remove'])]
    private ?Company $company = null;

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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        // unset the owning side of the relation if necessary
        if ($company === null && $this->company !== null) {
            $this->company->setSubscription(null);
        }

        // set the owning side of the relation if necessary
        if ($company !== null && $company->getSubscription() !== $this) {
            $company->setSubscription($this);
        }

        $this->company = $company;

        return $this;
    }
}
