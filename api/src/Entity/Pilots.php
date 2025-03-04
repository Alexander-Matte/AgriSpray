<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PilotsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PilotsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['pilot:read']],
    denormalizationContext: ['groups' => ['pilot:write']]
)]
#[UniqueEntity('email')]
class Pilots
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[Groups(['pilot:read'])]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['pilot:read', 'pilot:write'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    #[Groups(['pilot:read', 'pilot:write'])]
    private ?string $lastName = null;

    #[ORM\ManyToOne(inversedBy: 'pilot')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['pilot:read', 'pilot:write'])]
    private ?Aircrafts $aircrafts = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Email]
    #[Groups(['pilot:read', 'pilot:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 30, nullable: true)]
    #[Groups(['pilot:read', 'pilot:write'])]
    private ?string $phoneNumber = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAircrafts(): ?Aircrafts
    {
        return $this->aircrafts;
    }

    public function setAircrafts(?Aircrafts $aircrafts): static
    {
        $this->aircrafts = $aircrafts;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        dump($email);
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
