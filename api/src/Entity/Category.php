<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Offer::class)]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Offer>
     */
    public function getoffers(): Collection
    {
        return $this->offers;
    }

    public function addoffers(Offer $offers): self
    {
        if (!$this->offers->contains($offers)) {
            $this->offers->add($offers);
            $offers->setCategory($this);
        }

        return $this;
    }

    public function removeoffers(Offer $offers): self
    {
        if ($this->offers->removeElement($offers)) {
            // set the owning side to null (unless already changed)
            if ($offers->getCategory() === $this) {
                $offers->setCategory(null);
            }
        }

        return $this;
    }
}
