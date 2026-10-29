<?php

namespace App\DataFixtures;

use App\Entity\Cotisation;
use App\Entity\Seance;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CotisationFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['cotisations']; }
    public function getDependencies(): array { return [UserFixtures::class, SeanceFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $membres = $manager->getRepository(User::class)->findAll();
        $seances = $manager->getRepository(Seance::class)->findAll();
        foreach ($membres as $index => $membre) {
            foreach ($seances as $seanceIndex => $seance) {
                // Chaque membre cotise à une séance sur deux pour garder un jeu de données léger.
                if (($index + $seanceIndex) % 2 !== 0) { continue; }
                $cotisation = new Cotisation();
                $cotisation->setMontantEpargne('5000.00')
                    ->setMontantCaisseSociale('1000.00')
                    ->setDatePaiement($seance->getDateSeance())
                    ->setSeance($seance)->setMembre($membre);
                $manager->persist($cotisation);
            }
        }
        $manager->flush();
    }
}
