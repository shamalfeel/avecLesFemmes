<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\Seance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class SeanceFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['seances'];
    }

    public function load(ObjectManager $manager): void
    {
        $campagnes = $manager->getRepository(Campagne::class)->findAll();

        if (count($campagnes) === 0) {
            throw new \RuntimeException(
                'Aucune campagne trouvée. Charge d’abord les fixtures des campagnes.'
            );
        }

        foreach ($campagnes as $campagne) {
            for ($i = 1; $i <= 3; $i++) {
                $seance = new Seance();

                $seance
                    ->setDateSeance(new \DateTimeImmutable("2026-0$i-15"))
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->setCampagne($campagne);

                $manager->persist($seance);
            }
        }

        $manager->flush();
    }
}
