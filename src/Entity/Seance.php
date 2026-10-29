<?php

namespace App\Entity;
use App\Trait\DateTimeTrait;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Seance
{   use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateSeance = null;

    /**
     * @var Collection<int, Cotisation>
     */
    #[ORM\OneToMany(targetEntity: Cotisation::class, mappedBy: 'seance')]
    private Collection $cotisations;

    /**
     * @var Collection<int, Amende>
     */
    #[ORM\OneToMany(targetEntity: Amende::class, mappedBy: 'seance')]
    private Collection $amendes;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    private ?Campagne $cams = null;

    public function __construct()
    {
        $this->cotisations = new ArrayCollection();
        $this->amendes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSeance(): ?\DateTimeImmutable
    {
        return $this->dateSeance;
    }

    public function setDateSeance(\DateTimeImmutable $dateSeance): static
    {
        $this->dateSeance = $dateSeance;

        return $this;
    }

    

   

    /**
     * @return Collection<int, Cotisation>
     */
    public function getCotisations(): Collection
    {
        return $this->cotisations;
    }

    public function addCotisation(Cotisation $cotisation): static
    {
        if (!$this->cotisations->contains($cotisation)) {
            $this->cotisations->add($cotisation);
            $cotisation->setSeance($this);
        }

        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): static
    {
        if ($this->cotisations->removeElement($cotisation)) {
            // set the owning side to null (unless already changed)
            if ($cotisation->getSeance() === $this) {
                $cotisation->setSeance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Amende>
     */
    public function getAmendes(): Collection
    {
        return $this->amendes;
    }

    public function addAmende(Amende $amende): static
    {
        if (!$this->amendes->contains($amende)) {
            $this->amendes->add($amende);
            $amende->setSeance($this);
        }

        return $this;
    }

    public function removeAmende(Amende $amende): static
    {
        if ($this->amendes->removeElement($amende)) {
            // set the owning side to null (unless already changed)
            if ($amende->getSeance() === $this) {
                $amende->setSeance(null);
            }
        }

        return $this;
    }

    public function getCams(): ?Campagne
    {
        return $this->cams;
    }

    public function setCams(?Campagne $cams): static
    {
        $this->cams = $cams;

        return $this;
    }
}
