<?php

namespace App\Dto\Campagne;

use App\Entity\Campagne;

class CampagneListeDto
{
    public function __construct(
        
        public readonly ?string $nom,
        public readonly ?string $dateDebutAt,
        public readonly ?string $dateFin,
        public readonly string $type,
    ) {
    }

    public static function fromEntity(Campagne $campagne): self
    {
        return new self(
            
            nom: $campagne->getNom(),
            dateDebutAt: $campagne->getDateDebutAt()?->format('d/m/Y'),
            dateFin: $campagne->getDateFin()?->format('d/m/Y'),
            type: match (true) {
                $campagne instanceof \App\Entity\Epargne => 'Épargne',
                $campagne instanceof \App\Entity\Tontine => 'Tontine',
                default => 'Inconnu',
            },
        );
    }
}
