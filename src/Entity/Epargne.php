<?php

namespace App\Entity;

use App\Enum\Periodicite;
use App\Enum\TypeEpargne;
use App\Repository\EpargneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpargneRepository::class)]
class Epargne extends Campagne
{
    #[ORM\Column(nullable: true, enumType: TypeEpargne::class)]
    private ?TypeEpargne $typeEpargne = null;

    #[ORM\Column(enumType: Periodicite::class)]
    private ?Periodicite $periodicite = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $jourRencontre = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $montantCaissePresent = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $montantCaisseAbsent = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $montantAmendeJournaliere = null;

    public function getTypeEpargne(): ?TypeEpargne
    {
        return $this->typeEpargne;
    }

    public function setTypeEpargne(?TypeEpargne $typeEpargne): static
    {
        $this->typeEpargne = $typeEpargne;

        return $this;
    }

    public function getPeriodicite(): ?Periodicite
    {
        return $this->periodicite;
    }

    public function setPeriodicite(Periodicite $periodicite): static
    {
        $this->periodicite = $periodicite;

        return $this;
    }

    public function getJourRencontre(): ?int
    {
        return $this->jourRencontre;
    }

    public function setJourRencontre(?int $jourRencontre): static
    {
        $this->jourRencontre = $jourRencontre;

        return $this;
    }

    public function getMontantCaissePresent(): ?string
    {
        return $this->montantCaissePresent;
    }

    public function setMontantCaissePresent(?string $montantCaissePresent): static
    {
        $this->montantCaissePresent = $montantCaissePresent;

        return $this;
    }

    public function getMontantCaisseAbsent(): ?string
    {
        return $this->montantCaisseAbsent;
    }

    public function setMontantCaisseAbsent(?string $montantCaisseAbsent): static
    {
        $this->montantCaisseAbsent = $montantCaisseAbsent;

        return $this;
    }

    public function getMontantAmendeJournaliere(): ?string
    {
        return $this->montantAmendeJournaliere;
    }

    public function setMontantAmendeJournaliere(?string $montantAmendeJournaliere): static
    {
        $this->montantAmendeJournaliere = $montantAmendeJournaliere;

        return $this;
    }
}
