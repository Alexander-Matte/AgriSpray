<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FieldsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: FieldsRepository::class)]
#[ApiResource]
class Fields
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(inversedBy: 'fields')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customers $customer = null;

    #[ORM\Column]
    private ?int $total_ha = null;

    #[ORM\Column(length: 30)]
    private ?string $crop_type = null;

    /**
     * @var Collection<int, JobProfiles>
     */
    #[ORM\OneToMany(targetEntity: JobProfiles::class, mappedBy: 'field')]
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

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getTotalAcres(): ?int
    {
        return $this->total_ha;
    }

    public function setTotalAcres(int $total_ha): static
    {
        $this->total_ha = $total_ha;

        return $this;
    }

    public function getCropType(): ?string
    {
        return $this->crop_type;
    }

    public function setCropType(string $crop_type): static
    {
        $this->crop_type = $crop_type;

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
            $jobProfile->setField($this);
        }

        return $this;
    }

    public function removeJobProfile(JobProfiles $jobProfile): static
    {
        if ($this->jobProfiles->removeElement($jobProfile)) {
            // set the owning side to null (unless already changed)
            if ($jobProfile->getField() === $this) {
                $jobProfile->setField(null);
            }
        }

        return $this;
    }
}
