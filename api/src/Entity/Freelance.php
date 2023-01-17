<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FreelanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FreelanceRepository::class)]
#[ApiResource]
class Freelance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $surname = null;

    #[ORM\Column(nullable: true)]
    private ?int $siretnumber = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $role = [];

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $birthday = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $isverified = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $freelancetypes = [];

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $cvlink = null;

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

    public function getRole(): array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isIsverified(): ?bool
    {
        return $this->isverified;
    }

    public function setIsverified(bool $isverified): self
    {
        $this->isverified = $isverified;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFreelancetypes(): array
    {
        return $this->freelancetypes;
    }

    public function setFreelancetypes(?array $freelancetypes): self
    {
        $this->freelancetypes = $freelancetypes;

        return $this;
    }

    public function getCvlink(): ?string
    {
        return $this->cvlink;
    }

    public function setCvlink(?string $cvlink): self
    {
        $this->cvlink = $cvlink;

        return $this;
    }
}
