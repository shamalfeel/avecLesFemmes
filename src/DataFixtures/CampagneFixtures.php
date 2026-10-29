<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\Epargne;
use App\Entity\Exercice;
use App\Entity\Groupement;
use App\Entity\Tontine;
use App\Enum\Periodicite;
use App\Enum\TypeEpargne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CampagneFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['campagnes']; }
    public function getDependencies(): array { return [GroupementFixtures::class, ExerciceFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $groupements = $manager->getRepository(Groupement::class)->findAll();
        $exercices = $manager->getRepository(Exercice::class)->findAll();
        if (!$groupements || !$exercices) {
            throw new \RuntimeException('Il faut charger les fixtures des groupements et exercices avant les campagnes.');
        }

        foreach ($groupements as $index => $groupement) {
            $exercice = $exercices[$index % count($exercices)];

            $epargne = new Epargne();
            $epargne->setNom('Épargne annuelle ' . $groupement->getNom())
                ->setDateDebutAt(new \DateTimeImmutable('2026-01-01'))
                ->setDateFin(new \DateTimeImmutable('2026-12-31'))
                ->setMontant('10000.00')->setGroupement($groupement)->setExercice($exercice)
                ->setTypeEpargne(TypeEpargne::CALEBASSE)->setPeriodicite(Periodicite::HEBDOMADAIRE)
                ->setJourRencontre(6)->setMontantCaissePresent('1000.00')
                ->setMontantCaisseAbsent('500.00')->setMontantAmendeJournaliere('1000.00');
            $manager->persist($epargne);

            $tontine = new Tontine();
            $tontine->setNom('Tontine mensuelle ' . $groupement->getNom())
                ->setDateDebutAt(new \DateTimeImmutable('2026-01-01'))
                ->setDateFin(new \DateTimeImmutable('2026-12-31'))
                ->setMontant('5000.00')->setGroupement($groupement)->setExercice($exercice);
            $manager->persist($tontine);
        }
        $manager->flush();
    }
}
