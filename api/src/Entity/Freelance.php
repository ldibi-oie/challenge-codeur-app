<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\FreelanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\MediaObject;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name: '`freelance`')]
#[ORM\Entity(repositoryClass: FreelanceRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['user' ,'freelance']]
)]
class Freelance
{

    use TimestampableEntity;

    #[Groups('user')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('user' , 'freelance')]
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[Groups('user' , 'freelance')]
    #[ORM\Column(length: 50)]
    private ?string $surname = null;

    #[Groups('user' , 'freelance')]
    #[ORM\Column(nullable: true)]
    private ?int $siretnumber = null;

    #[Groups('user' , 'freelance')]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $birthday = null;

    #[Groups('user' , 'freelance')]
    #[ORM\ManyToOne(targetEntity: MediaObject::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'])]
    public ?MediaObject $cv= null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'])]
    public ?MediaObject $profile = null;

    #[Groups('user' , 'freelance')]
    #[ORM\ManyToMany(targetEntity: Offer::class, mappedBy: 'candidates')]
    private Collection $offers;



    #[ORM\OneToOne(inversedBy: 'freelance', cascade: ['persist', 'remove'])]
    private ?User $userId = null;

    #[Groups('user' , 'freelance')]
    #[ORM\OneToMany(mappedBy: 'selectedCandidate', targetEntity: Offer::class)]
    private Collection $isSelectedCandidateList;

    #[Groups('user' , 'freelance')]
    #[ORM\ManyToMany(targetEntity: Keyword::class, inversedBy: 'freelances', cascade: ['persist'])]
    private Collection $keywords;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->keywords = new ArrayCollection();
        $this->isSelectedCandidateList = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getSiretnumber(): ?int
    {
        return $this->siretnumber;
    }

    public function setSiretnumber(?int $siretnumber): self
    {
        $this->siretnumber = $siretnumber;

        return $this;
    }
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(?string $birthday): self
    {
        $this->birthday = $birthday;

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
            $offer->addCandidate($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            $offer->removeCandidate($this);
        }

        return $this;
    }


    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getProfile(): ?MediaObject
    {
        return $this->profile;
    }
    public function setProfile(?MediaObject $profile): self
    {
        $this->profile = $profile;

        return $this;
    }
    public function getCv(): ?MediaObject
    {
        return $this->cv;
    }
    public function setCv(?MediaObject $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * @return Collection<int, Offer>
     */
    public function getIsSelectedCandidateList(): Collection
    {
        return $this->isSelectedCandidateList;
    }

    public function addIsSelectedCandidateList(Offer $isSelectedCandidateList): self
    {
        if (!$this->isSelectedCandidateList->contains($isSelectedCandidateList)) {
            $this->isSelectedCandidateList->add($isSelectedCandidateList);
            $isSelectedCandidateList->setSelectedCandidate($this);
        }

        return $this;
    }

    public function removeIsSelectedCandidateList(Offer $isSelectedCandidateList): self
    {
        if ($this->isSelectedCandidateList->removeElement($isSelectedCandidateList)) {
            // set the owning side to null (unless already changed)
            if ($isSelectedCandidateList->getSelectedCandidate() === $this) {
                $isSelectedCandidateList->setSelectedCandidate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Keyword>
     */
    public function getKeywords(): Collection
    {
        return $this->keywords;
    }

    public function addKeyword(Keyword $keyword): self
    {
        if (!$this->keywords->contains($keyword)) {
            $this->keywords->add($keyword);
        }

        return $this;
    }

    public function removeKeyword(Keyword $keyword): self
    {
        $this->keywords->removeElement($keyword);

        return $this;
    }

}
