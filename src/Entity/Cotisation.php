<?php

namespace App\Entity;

use App\Repository\CotisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CotisationRepository::class)]
class Cotisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montantEpargne = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montantCaisseSociale = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $datePaiement = null;

    #[ORM\ManyToOne(inversedBy: 'cotisations')]
    private ?Seance $seance = null;

    #[ORM\ManyToOne(inversedBy: 'cotisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $membre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantEpargne(): ?string
    {
        return $this->montantEpargne;
    }

    public function setMontantEpargne(string $montantEpargne): static
    {
        $this->montantEpargne = $montantEpargne;

        return $this;
    }

    public function getMontantCaisseSociale(): ?string
    {
        return $this->montantCaisseSociale;
    }

    public function setMontantCaisseSociale(string $montantCaisseSociale): static
    {
        $this->montantCaisseSociale = $montantCaisseSociale;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeImmutable
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeImmutable $datePaiement): static
    {
        $this->datePaiement = $datePaiement;

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

    public function getMembre(): ?User
    {
        return $this->membre;
    }

    public function setMembre(?User $membre): static
    {
        $this->membre = $membre;

        return $this;
    }
}
