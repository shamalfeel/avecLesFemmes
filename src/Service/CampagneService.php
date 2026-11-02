<?php
namespace App\Service;

use App\Dto\Campagne\CampagneListeDto;
use App\Repository\CampagneRepository;

class CampagneService
{
    public function __construct(
        private readonly CampagneRepository $campagneRepository
    ) {
    }

    /**
     * Retourne la liste des campagnes sous forme de DTO.
     */
    public function getListeCampagnes(): array
    {
        $campagnes = $this->campagneRepository->findAllCampagnes();

        return array_map(
            fn ($campagne) => CampagneListeDto::fromEntity($campagne),
            $campagnes
        );
    }
}
