<?php

namespace App\Entity;
use App\Trait\DateTimeTrait;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'membre_simple' => MembreSimple::class,
    'tresorier' => Tresorier::class,
    'admin' => Admin::class,
])]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
abstract class User
{   use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomComplet = null;

    #[ORM\Column(length: 80)]
    private ?string $tel = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * @var Collection<int, ModeCotisation>
     */
    #[ORM\OneToMany(targetEntity: ModeCotisation::class, mappedBy: 'membre')]
    private Collection $modeCotisations;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

    /**
     * @var Collection<int, Cotisation>
     */
    #[ORM\OneToMany(targetEntity: Cotisation::class, mappedBy: 'membre', orphanRemoval: true)]
    private Collection $cotisations;

    /**
     * @var Collection<int, Amende>
     */
    #[ORM\OneToMany(targetEntity: Amende::class, mappedBy: 'membre', orphanRemoval: true)]
    private Collection $amendes;

    public function __construct()
    {
        $this->modeCotisations = new ArrayCollection();
        $this->cotisations = new ArrayCollection();
        $this->amendes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): static
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, ModeCotisation>
     */
    public function getModeCotisations(): Collection
    {
        return $this->modeCotisations;
    }

    public function addModeCotisation(ModeCotisation $modeCotisation): static
    {
        if (!$this->modeCotisations->contains($modeCotisation)) {
            $this->modeCotisations->add($modeCotisation);
            $modeCotisation->setMembre($this);
        }

        return $this;
    }

    public function removeModeCotisation(ModeCotisation $modeCotisation): static
    {
        if ($this->modeCotisations->removeElement($modeCotisation)) {
            // set the owning side to null (unless already changed)
            if ($modeCotisation->getMembre() === $this) {
                $modeCotisation->setMembre(null);
            }
        }

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
            $cotisation->setMembre($this);
        }

        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): static
    {
        if ($this->cotisations->removeElement($cotisation)) {
            // set the owning side to null (unless already changed)
            if ($cotisation->getMembre() === $this) {
                $cotisation->setMembre(null);
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
            $amende->setMembre($this);
        }

        return $this;
    }

    public function removeAmende(Amende $amende): static
    {
        if ($this->amendes->removeElement($amende)) {
            // set the owning side to null (unless already changed)
            if ($amende->getMembre() === $this) {
                $amende->setMembre(null);
            }
        }

        return $this;
    }
}
