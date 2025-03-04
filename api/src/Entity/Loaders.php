<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LoadersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LoadersRepository::class)]
#[ApiResource]
class Loaders
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Assert\Unique]
    private ?string $email = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $phone_number = null;

    /**
     * @var Collection<int, JobProfiles>
     */
    #[ORM\OneToMany(targetEntity: JobProfiles::class, mappedBy: 'loader')]
    private Collection $jobProfiles;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->jobProfiles = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * @return Collection<int, JobProfiles>
     */
    public function getJobProfiles(): Collection
    {
        return $this->jobProfiles;
    }

    public function addJobProfile(JobProfiles $jobProfile): static
    {
        if (!$this->jobProfiles->contains($jobProfile)) {
            $this->jobProfiles->add($jobProfile);
            $jobProfile->setLoader($this);
        }

        return $this;
    }

    public function removeJobProfile(JobProfiles $jobProfile): static
    {
        if ($this->jobProfiles->removeElement($jobProfile)) {
            // set the owning side to null (unless already changed)
            if ($jobProfile->getLoader() === $this) {
                $jobProfile->setLoader(null);
            }
        }

        return $this;
    }
}
