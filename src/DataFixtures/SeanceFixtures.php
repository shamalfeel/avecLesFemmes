<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\Seance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeanceFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['seances']; }
    public function getDependencies(): array { return [CampagneFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $campagnes = $manager->getRepository(Campagne::class)->findAll();
        foreach ($campagnes as $campagne) {
            for ($i = 1; $i <= 3; $i++) {
                $seance = new Seance();
                $seance->setDateSeance(new \DateTimeImmutable(sprintf('2026-%02d-15', $i)))
                    ->setCams($campagne);
                $manager->persist($seance);
            }
        }
        $manager->flush();
    }
}
