<?php

namespace App\Service;

use App\Dto\GroupementListeDto;
use App\Entity\Exercice;
use App\Entity\Groupement;
use App\Enum\StatusExercice;
use App\Repository\GroupementRepository;

class GroupementService
{
    public function __construct(
        private readonly GroupementRepository $groupementRepository
    ) {
    }

    
    public function getListeGroupements(?String $valeur): array
    {
        if ($valeur) {
            $groupements = $this->groupementRepository->findByVilleouNom($valeur);
        } else {
            $groupements = $this->groupementRepository->findAllWithExercices();
        }

        $resultats = [];

        foreach ($groupements as $groupement) {
            $exerciceEnCours = $this->trouverExerciceEnCours($groupement);

            $resultats[] = GroupementListeDto::fromEntity(
                $groupement,
                $exerciceEnCours
            );
        }

        return $resultats;
    }

    
    private function trouverExerciceEnCours(
        Groupement $groupement
    ): ?Exercice {
        foreach ($groupement->getExercices() as $exercice) {
            if ($exercice->getStatus() === StatusExercice::ENCOURS) {
                return $exercice;
            }
        }

        return null;
    }

    

    
}