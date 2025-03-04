<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChemicalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ChemicalsRepository::class)]
#[ApiResource]
class Chemicals
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $manufacturer = null;

    #[ORM\Column]
    private ?float $application_rate_lph = null;

    /**
     * @var Collection<int, JobProfiles>
     */
    #[ORM\OneToMany(targetEntity: JobProfiles::class, mappedBy: 'chemical')]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getApplicationRateGpa(): ?float
    {
        return $this->application_rate_lph;
    }

    public function setApplicationRateGpa(float $application_rate_lph): static
    {
        $this->application_rate_lph = $application_rate_lph;

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
            $jobProfile->setChemical($this);
        }

        return $this;
    }

    public function removeJobProfile(JobProfiles $jobProfile): static
    {
        if ($this->jobProfiles->removeElement($jobProfile)) {
            // set the owning side to null (unless already changed)
            if ($jobProfile->getChemical() === $this) {
                $jobProfile->setChemical(null);
            }
        }

        return $this;
    }
}
