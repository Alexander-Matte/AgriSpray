<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
#[ApiResource]
class Customers
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company_name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $phone_number = null;

    /**
     * @var Collection<int, Fields>
     */
    #[ORM\OneToMany(targetEntity: Fields::class, mappedBy: 'customer')]
    private Collection $fields;

    /**
     * @var Collection<int, JobProfiles>
     */
    #[ORM\OneToMany(targetEntity: JobProfiles::class, mappedBy: 'customer')]
    private Collection $jobProfiles;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->fields = new ArrayCollection();
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

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(?string $company_name): static
    {
        $this->company_name = $company_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
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
     * @return Collection<int, Fields>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(Fields $field): static
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
            $field->setCustomer($this);
        }

        return $this;
    }

    public function removeField(Fields $field): static
    {
        if ($this->fields->removeElement($field)) {
            // set the owning side to null (unless already changed)
            if ($field->getCustomer() === $this) {
                $field->setCustomer(null);
            }
        }

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
            $jobProfile->setCustomer($this);
        }

        return $this;
    }

    public function removeJobProfile(JobProfiles $jobProfile): static
    {
        if ($this->jobProfiles->removeElement($jobProfile)) {
            // set the owning side to null (unless already changed)
            if ($jobProfile->getCustomer() === $this) {
                $jobProfile->setCustomer(null);
            }
        }

        return $this;
    }
}
