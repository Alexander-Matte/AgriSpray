<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\JobProfilesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: JobProfilesRepository::class)]
#[ApiResource]
class JobProfiles
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\ManyToOne(inversedBy: 'customer')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aircrafts $aircraft = null;

    #[ORM\ManyToOne(inversedBy: 'jobProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customers $customer = null;

    #[ORM\ManyToOne(inversedBy: 'jobProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fields $field = null;

    #[ORM\ManyToOne(inversedBy: 'jobProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chemicals $chemical = null;

    #[ORM\ManyToOne(inversedBy: 'jobProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Loaders $loader = null;

    #[ORM\Column(length: 50)]
    private ?string $Status = null;

    #[ORM\OneToOne(targetEntity: LoadPlans::class, mappedBy: 'job', cascade: ['persist', 'remove'])]
    private ?LoadPlans $loadPlan = null;
    
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getAircraft(): ?Aircrafts
    {
        return $this->aircraft;
    }

    public function setAircraft(?Aircrafts $aircraft): static
    {
        $this->aircraft = $aircraft;

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

    public function getField(): ?Fields
    {
        return $this->field;
    }

    public function setField(?Fields $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function getChemical(): ?Chemicals
    {
        return $this->chemical;
    }

    public function setChemical(?Chemicals $chemical): static
    {
        $this->chemical = $chemical;

        return $this;
    }

    public function getLoader(): ?Loaders
    {
        return $this->loader;
    }

    public function setLoader(?Loaders $loader): static
    {
        $this->loader = $loader;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * Get the load plan associated with the job.
     */
    public function getLoadPlan(): ?LoadPlans
    {
        return $this->loadPlan;
    }
    
    /**
     * Set the load plan for the job.
     */
    public function setLoadPlan(?LoadPlans $loadPlan): static
    {
        $this->loadPlan = $loadPlan;
    
        // If you want to set the owning side, uncomment the next line
        // if ($loadPlan && $loadPlan->getJob() !== $this) {
        //     $loadPlan->setJob($this);
        // }
    
        return $this;
    }
}
