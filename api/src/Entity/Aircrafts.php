<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AircraftsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AircraftsRepository::class)]
#[ApiResource]
class Aircrafts
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\Column(length: 50)]
    private ?string $make = null;

    #[ORM\Column(length: 100)]
    private ?string $model = null;

    #[ORM\Column(length: 10)]
    private ?string $callsign = null;

    #[ORM\Column]
    private ?int $max_capacity_liters = null;

    /**
     * @var Collection<int, Pilots>
     */
    #[ORM\OneToMany(targetEntity: Pilots::class, mappedBy: 'aircrafts')]
    private Collection $pilot;

    /**
     * @var Collection<int, JobProfiles>
     */
    #[ORM\OneToMany(targetEntity: JobProfiles::class, mappedBy: 'aircraft')]
    private Collection $customer;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->pilot = new ArrayCollection();
        $this->customer = new ArrayCollection();
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

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getCallsign(): ?string
    {
        return $this->callsign;
    }

    public function setCallsign(string $callsign): static
    {
        $this->callsign = $callsign;

        return $this;
    }

    public function getMaxCapacityGallons(): ?int
    {
        return $this->max_capacity_liters;
    }

    public function setMaxCapacityGallons(int $max_capacity_liters): static
    {
        $this->max_capacity_liters = $max_capacity_liters;

        return $this;
    }

    /**
     * @return Collection<int, Pilots>
     */
    public function getPilot(): Collection
    {
        return $this->pilot;
    }

    public function addPilot(Pilots $pilot): static
    {
        if (!$this->pilot->contains($pilot)) {
            $this->pilot->add($pilot);
            $pilot->setAircrafts($this);
        }

        return $this;
    }

    public function removePilot(Pilots $pilot): static
    {
        if ($this->pilot->removeElement($pilot)) {
            // set the owning side to null (unless already changed)
            if ($pilot->getAircrafts() === $this) {
                $pilot->setAircrafts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JobProfiles>
     */
    public function getCustomer(): Collection
    {
        return $this->customer;
    }

    public function addCustomer(JobProfiles $customer): static
    {
        if (!$this->customer->contains($customer)) {
            $this->customer->add($customer);
            $customer->setAircraft($this);
        }

        return $this;
    }

    public function removeCustomer(JobProfiles $customer): static
    {
        if ($this->customer->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getAircraft() === $this) {
                $customer->setAircraft(null);
            }
        }

        return $this;
    }
}
