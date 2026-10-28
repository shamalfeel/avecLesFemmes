<?php

namespace App\Entity;

use App\Repository\GroupementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupementRepository::class)]
class Groupement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $tel = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    

    /**
     * @var Collection<int, Campagne>
     */
    #[ORM\OneToMany(targetEntity: Campagne::class, mappedBy: 'groupement')]
    private Collection $campagnes;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'groupement')]
    private Collection $users;

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'groupement', orphanRemoval: true)]
    private Collection $exercices;

    /**
     * @var Collection<int, MouvementCaisseSociale>
     */
    #[ORM\OneToMany(targetEntity: MouvementCaisseSociale::class, mappedBy: 'groupement')]
    private Collection $mouvementCaisseSociales;

    public function __construct()
    {
        $this->campagnes = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->exercices = new ArrayCollection();
        $this->mouvementCaisseSociales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

   

    /**
     * @return Collection<int, Campagne>
     */
    public function getCampagnes(): Collection
    {
        return $this->campagnes;
    }

    public function addCampagne(Campagne $campagne): static
    {
        if (!$this->campagnes->contains($campagne)) {
            $this->campagnes->add($campagne);
            $campagne->setGroupement($this);
        }

        return $this;
    }

    public function removeCampagne(Campagne $campagne): static
    {
        if ($this->campagnes->removeElement($campagne)) {
            // set the owning side to null (unless already changed)
            if ($campagne->getGroupement() === $this) {
                $campagne->setGroupement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setGroupement($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getGroupement() === $this) {
                $user->setGroupement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
            $exercice->setGroupement($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getGroupement() === $this) {
                $exercice->setGroupement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MouvementCaisseSociale>
     */
    public function getMouvementCaisseSociales(): Collection
    {
        return $this->mouvementCaisseSociales;
    }

    public function addMouvementCaisseSociale(MouvementCaisseSociale $mouvementCaisseSociale): static
    {
        if (!$this->mouvementCaisseSociales->contains($mouvementCaisseSociale)) {
            $this->mouvementCaisseSociales->add($mouvementCaisseSociale);
            $mouvementCaisseSociale->setGroupement($this);
        }

        return $this;
    }

    public function removeMouvementCaisseSociale(MouvementCaisseSociale $mouvementCaisseSociale): static
    {
        if ($this->mouvementCaisseSociales->removeElement($mouvementCaisseSociale)) {
            // set the owning side to null (unless already changed)
            if ($mouvementCaisseSociale->getGroupement() === $this) {
                $mouvementCaisseSociale->setGroupement(null);
            }
        }

        return $this;
    }
}
