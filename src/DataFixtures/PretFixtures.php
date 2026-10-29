<?php

namespace App\DataFixtures;

use App\Entity\Pret;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PretFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['prets']; }
    public function getDependencies(): array { return [UserFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $utilisateurs = $manager->getRepository(User::class)->findAll();
        foreach ($utilisateurs as $index => $utilisateur) {
            $pret = new Pret();
            $pret->setMontant((string) (10000 + ($index * 5000)))
                ->setDatePret(new \DateTimeImmutable('2026-02-01'))
                ->setDateEcheance(new \DateTimeImmutable('2026-12-31'))
                ->setIsPaid($index % 2 === 0)->setMembre($utilisateur);
            $manager->persist($pret);
        }
        $manager->flush();
    }
}
