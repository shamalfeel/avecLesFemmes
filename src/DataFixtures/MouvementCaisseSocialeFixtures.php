<?php

namespace App\DataFixtures;

use App\Entity\Groupement;
use App\Entity\MouvementCaisseSociale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MouvementCaisseSocialeFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['mouvements_caisse_sociale']; }
    public function getDependencies(): array { return [GroupementFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $groupements = $manager->getRepository(Groupement::class)->findAll();
        foreach ($groupements as $index => $groupement) {
            $entree = new MouvementCaisseSociale();
            $entree->setType('ENTREE')->setMontant('25000.00')
                ->setDateMouvement(new \DateTimeImmutable('2026-01-15'))
                ->setDescription('Cotisations de caisse sociale')
                ->setGroupement($groupement);
            $manager->persist($entree);

            $sortie = new MouvementCaisseSociale();
            $sortie->setType('SORTIE')->setMontant((string) (5000 + $index * 1000))
                ->setDateMouvement(new \DateTimeImmutable('2026-02-15'))
                ->setDescription('Dépense de fonctionnement')
                ->setGroupement($groupement);
            $manager->persist($sortie);
        }
        $manager->flush();
    }
}
