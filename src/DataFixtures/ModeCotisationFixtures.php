<?php

namespace App\DataFixtures;

use App\Entity\ModeCotisation;
use App\Entity\Campagne;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ModeCotisationFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['mode_cotisations'];
    }

    public function load(ObjectManager $manager): void
    {
        $campagnes = $manager->getRepository(Campagne::class)->findAll();
        $membres = $manager->getRepository(User::class)->findAll();

        if (count($campagnes) === 0) {
            throw new \RuntimeException(
                'Aucune campagne trouvée. Charge d’abord les fixtures des campagnes.'
            );
        }

        if (count($membres) === 0) {
            throw new \RuntimeException(
                'Aucun utilisateur trouvé. Charge d’abord les fixtures des utilisateurs.'
            );
        }

        foreach ($membres as $index => $membre) {
            foreach ($campagnes as $campagne) {
                $mode = new ModeCotisation();

                $mode
                    ->setIsLibre($index % 2 === 0)
                    ->setCampagne($campagne)
                    ->setMembre($membre);

                $manager->persist($mode);
            }
        }

        $manager->flush();
    }
}
