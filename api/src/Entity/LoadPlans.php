<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LoadPlansRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LoadPlansRepository::class)]
#[ApiResource]
class LoadPlans
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    // OneToOne with JobProfiles (previously 'job_id')
    #[ORM\OneToOne(inversedBy: 'loadPlan')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JobProfiles $job = null;

    #[ORM\Column(length: 255)]
    private ?string $strategy = null;

    /**
     * @var Collection<int, LoadDetails>
     */
    #[ORM\OneToMany(targetEntity: LoadDetails::class, mappedBy: 'loadPlan')]
    private Collection $loadDetails;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->loadDetails = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    // Set the ID using UUID
    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    // Getter and Setter for JobProfile
    public function getJob(): ?JobProfiles
    {
        return $this->job;
    }

    public function setJob(?JobProfiles $job): static
    {
        $this->job = $job;

        return $this;
    }

    // Getter and Setter for Strategy
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function setStrategy(string $strategy): static
    {
        $this->strategy = $strategy;

        return $this;
    }

    // Getter for LoadDetails
    public function getLoadDetails(): Collection
    {
        return $this->loadDetails;
    }

    // Add LoadDetail to LoadPlan
    public function addLoadDetail(LoadDetails $loadDetail): static
    {
        if (!$this->loadDetails->contains($loadDetail)) {
            $this->loadDetails->add($loadDetail);
            $loadDetail->setLoadPlan($this);
        }

        return $this;
    }

    // Remove LoadDetail from LoadPlan
    public function removeLoadDetail(LoadDetails $loadDetail): static
    {
        if ($this->loadDetails->removeElement($loadDetail)) {
            // Set the owning side to null (unless already changed)
            if ($loadDetail->getLoadPlan() === $this) {
                $loadDetail->setLoadPlan(null);
            }
        }

        return $this;
    }
}
