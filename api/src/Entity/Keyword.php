<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\KeywordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampableTrait;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: KeywordRepository::class)]
#[ApiResource]
class Keyword
{

    use TimestampableTrait;

    #[Groups('user' , 'freelance', 'offer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('user' , 'freelance', 'offer')]
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Freelance::class, mappedBy: 'keywords', cascade: ['persist'])]
    private Collection $freelances;

    #[ORM\ManyToMany(targetEntity: Offer::class, mappedBy: 'keywords', cascade: ['persist'])]
    private Collection $offers;

    public function __construct()
    {
        $this->freelances = new ArrayCollection();
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
     * @return Collection<int, Freelance>
     */
    public function getFreelances(): Collection
    {
        return $this->freelances;
    }

    public function addFreelance(Freelance $freelance): self
    {
        if (!$this->freelances->contains($freelance)) {
            $this->freelances->add($freelance);
            $freelance->addKeyword($this);
        }

        return $this;
    }

    public function removeFreelance(Freelance $freelance): self
    {
        if ($this->freelances->removeElement($freelance)) {
            $freelance->removeKeyword($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Offer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->addKeyword($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            $offer->removeKeyword($this);
        }

        return $this;
    }
}
