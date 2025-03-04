<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LoadDetailsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LoadDetailsRepository::class)]
#[ApiResource]
class LoadDetails
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid")]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(inversedBy: 'loadDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LoadPlans $loadPlan = null;

    #[ORM\Column]
    private ?int $load_number = null;

    #[ORM\Column]
    private ?float $chemical_liters = null;

    #[ORM\Column]
    private ?float $water_liters = null;

    #[ORM\Column]
    private ?float $total_liters = null;

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

    public function getLoadPlan(): ?LoadPlans
    {
        return $this->loadPlan;
    }

    public function setLoadPlan(?LoadPlans $loadPlan): static
    {
        $this->loadPlan = $loadPlan;

        return $this;
    }

    public function getLoadNumber(): ?int
    {
        return $this->load_number;
    }

    public function setLoadNumber(int $load_number): static
    {
        $this->load_number = $load_number;

        return $this;
    }

    public function getChemicalLiters(): ?float
    {
        return $this->chemical_liters;
    }

    public function setChemicalLiters(float $chemical_liters): static
    {
        $this->chemical_liters = $chemical_liters;

        return $this;
    }

    public function getWaterLiters(): ?float
    {
        return $this->water_liters;
    }

    public function setWaterLiters(float $water_liters): static
    {
        $this->water_liters = $water_liters;

        return $this;
    }

    public function getTotalLiters(): ?float
    {
        return $this->total_liters;
    }

    public function setTotalLiters(float $total_liters): static
    {
        $this->total_liters = $total_liters;

        return $this;
    }
}
