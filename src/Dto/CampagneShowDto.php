<?php

namespace App\Dto\Campagne;

use App\Entity\Campagne;

class CampagneShowDto
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nom,
        public readonly ?\DateTimeImmutable $dateDebutAt,
        public readonly ?\DateTimeImmutable $dateFin,
        public readonly ?string $montant,
        public readonly ?string $groupement,
        public readonly ?string $exercice,
        public readonly string $type,
    ) {
    }

    public static function fromEntity(Campagne $campagne): self
    {
        return new self(
            id: $campagne->getId(),
          exercice: $campagne->getExercice()?->getStatus(),
            type: match (true) {
                $campagne instanceof \App\Entity\Epargne => 'Épargne',
                $campagne instanceof \App\Entity\Tontine => 'Tontine',
                default => 'Inconnu',
            },
        );
    }
}