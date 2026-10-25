<?php

namespace App\DataFixtures;

use App\Entity\Pret;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class PretFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['prets'];
    }

    public function load(ObjectManager $manager): void
    {
        $utilisateurs = $manager->getRepository(User::class)->findAll();

        if (count($utilisateurs) === 0) {
            throw new \RuntimeException(
                'Aucun utilisateur trouvé. Charge d’abord les fixtures des utilisateurs.'
            );
        }

        foreach ($utilisateurs as $index => $utilisateur) {
            $pret = new Pret();

            $pret
                ->setMontant((string) random_int(10000, 100000))
                ->setDatePret(new \DateTimeImmutable('2026-01-01'))
                ->setDateEcheance(new \DateTimeImmutable('2026-12-31'))
                ->setIsPaid((bool) random_int(0, 1))
                ->setMembre($utilisateur);

            $manager->persist($pret);
        }

        $manager->flush();
    }
}
