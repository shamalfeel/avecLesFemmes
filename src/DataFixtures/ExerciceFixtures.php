<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Groupement;
use App\Enum\StatusExercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExerciceFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['exercices']; }
    public function getDependencies(): array { return [GroupementFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $groupements = $manager->getRepository(Groupement::class)->findAll();
        foreach ($groupements as $groupement) {
            $exercice = new Exercice();
            $exercice->setDateDebut(new \DateTime('2026-01-01'))
                ->setDateFin(new \DateTime('2026-12-31'))
                ->setLimitePretsAt(new \DateTimeImmutable('2026-10-31'))
                ->setRetributionDateAt(new \DateTimeImmutable('2026-12-15'))
                ->setStatus(StatusExercice::ENCOURS)
                ->setGroupement($groupement);
            $manager->persist($exercice);
        }
        $manager->flush();
    }
}
