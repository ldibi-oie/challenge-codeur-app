<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
#[ApiResource]
class Subscription
{

    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\OneToOne(mappedBy: 'subscription', cascade: ['persist', 'remove'])]
    private ?Company $company = null;

    #[ORM\Column(length: 255)]
    private ?string $stripeId = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $isActive = null;

    #[ORM\ManyToOne]
    private ?Plan $plan = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $currentPeriodStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $currentPeriodEnd = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStripeId(): ?string
    {
        return $this->stripeId;
    }

    public function setStripeId(string $stripeId): self
    {
        $this->stripeId = $stripeId;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getCurrentPeriodStart(): ?\DateTimeInterface
    {
        return $this->currentPeriodStart;
    }

    public function setCurrentPeriodStart(\DateTimeInterface $currentPeriodStart): self
    {
        $this->currentPeriodStart = $currentPeriodStart;

        return $this;
    }

    public function getCurrentPeriodEnd(): ?\DateTimeInterface
    {
        return $this->currentPeriodEnd;
    }

    public function setCurrentPeriodEnd(\DateTimeInterface $currentPeriodEnd): self
    {
        $this->currentPeriodEnd = $currentPeriodEnd;

        return $this;
    }
}
