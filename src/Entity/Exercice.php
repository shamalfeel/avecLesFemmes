<?php

namespace App\Entity;

use App\Enum\StatusExercice;
use App\Repository\ExerciceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateFin = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $limitePretsAt = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $retributionDateAt = null;

    #[ORM\Column(enumType: StatusExercice::class)]
    private ?StatusExercice $status = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getLimitePretsAt(): ?\DateTimeImmutable
    {
        return $this->limitePretsAt;
    }

    public function setLimitePretsAt(?\DateTimeImmutable $limitePretsAt): static
    {
        $this->limitePretsAt = $limitePretsAt;

        return $this;
    }

    public function getRetributionDateAt(): ?\DateTimeImmutable
    {
        return $this->retributionDateAt;
    }

    public function setRetributionDateAt(?\DateTimeImmutable $retributionDateAt): static
    {
        $this->retributionDateAt = $retributionDateAt;

        return $this;
    }

    public function getStatus(): ?StatusExercice
    {
        return $this->status;
    }

    public function setStatus(StatusExercice $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getGroupement(): ?Groupement
    {
        return $this->groupement;
    }

    public function setGroupement(?Groupement $groupement): static
    {
        $this->groupement = $groupement;

        return $this;
    }

  
}
