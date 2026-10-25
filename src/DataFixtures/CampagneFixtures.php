<?php

namespace App\DataFixtures;

use App\Entity\Epargne;
use App\Entity\Tontine;
use App\Entity\Groupement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CampagneFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['campagnes'];
    }

    public function load(ObjectManager $manager): void
    {
        $groupements = $manager->getRepository(Groupement::class)->findAll();

        if (count($groupements) === 0) {
            throw new \RuntimeException(
                'Aucun groupement trouvé. Charge d’abord les fixtures de Groupement.'
            );
        }

        // Campagne d'épargne
        $epargne = new Epargne();
        $epargne
            ->setNom('Épargne annuelle')
            ->setDateDebutAt(new \DateTimeImmutable('2026-01-01'))
            ->setDateFin(new \DateTimeImmutable('2026-12-31'))
            ->setMontant('10000.00')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setGroupement($groupements[0]);

        $manager->persist($epargne);

        // Campagne de tontine
        $tontine = new Tontine();
        $tontine
            ->setNom('Tontine mensuelle')
            ->setDateDebutAt(new \DateTimeImmutable('2026-01-01'))
            ->setDateFin(new \DateTimeImmutable('2026-12-31'))
            ->setMontant('5000.00')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setGroupement($groupements[0]);

        $manager->persist($tontine);

        $manager->flush();
    }
}