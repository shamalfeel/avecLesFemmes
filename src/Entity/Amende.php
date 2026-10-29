<?php

namespace App\Entity;
use App\Trait\DateTimeTrait;
use App\Repository\AmendeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmendeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Amende
{   use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montant = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateAmende = null;

    #[ORM\Column]
    private ?int $nombreJours = null;

    #[ORM\Column]
    private ?bool $isPaye = null;

    #[ORM\ManyToOne(inversedBy: 'amendes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $membre = null;

    #[ORM\ManyToOne(inversedBy: 'amendes')]
    private ?Seance $seance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateAmende(): ?\DateTimeImmutable
    {
        return $this->dateAmende;
    }

    public function setDateAmende(\DateTimeImmutable $dateAmende): static
    {
        $this->dateAmende = $dateAmende;

        return $this;
    }

    public function getNombreJours(): ?int
    {
        return $this->nombreJours;
    }

    public function setNombreJours(int $nombreJours): static
    {
        $this->nombreJours = $nombreJours;

        return $this;
    }

    public function isPaye(): ?bool
    {
        return $this->isPaye;
    }

    public function setIsPaye(bool $isPaye): static
    {
        $this->isPaye = $isPaye;

        return $this;
    }

    public function getMembre(): ?User
    {
        return $this->membre;
    }

    public function setMembre(?User $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getSeance(): ?Seance
    {
        return $this->seance;
    }

    public function setSeance(?Seance $seance): static
    {
        $this->seance = $seance;

        return $this;
    }
}
