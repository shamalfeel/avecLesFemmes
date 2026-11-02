<?php

namespace App\Dto;

use App\Entity\Exercice;
use App\Entity\Groupement;

class GroupementListeDto
{
    public function __construct(
        public int $id,
        public string $nom,
        public ?string $tel,
        public ?string $adresse,
        public ?string $exerciceEnCours,
        public int $nombreExercices,
    ) {
    }

    public static function fromEntity(
        Groupement $groupement,
        ?Exercice $exercice
    ): self {
        $exerciceEnCours = null;

        if ($exercice !== null) {
            $dateDebut = $exercice->getDateDebut()?->format('d/m/Y');
            $dateFin = $exercice->getDateFin()?->format('d/m/Y');

            $exerciceEnCours = $dateDebut;

            if ($dateFin !== null) {
                $exerciceEnCours .= ' - ' . $dateFin;
            }
        }

        return new self(
            id: $groupement->getId(),
            nom: $groupement->getNom(),
            tel: $groupement->getTel(),
            adresse: $groupement->getAdresse(),
            exerciceEnCours: $exerciceEnCours,
            nombreExercices: $groupement->getExercices()->count(),
        );
    }
}
