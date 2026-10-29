<?php

namespace App\DataFixtures;

use App\Entity\Amende;
use App\Entity\Seance;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AmendeFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['amendes']; }
    public function getDependencies(): array { return [UserFixtures::class, SeanceFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $membres = $manager->getRepository(User::class)->findAll();
        $seances = $manager->getRepository(Seance::class)->findAll();
        foreach ($membres as $index => $membre) {
            $amende = new Amende();
            $amende->setMontant('1000.00')
                ->setDateAmende(new \DateTimeImmutable('2026-03-15'))
                ->setNombreJours(1 + ($index % 3))
                ->setIsPaye($index % 2 === 0)
                ->setMembre($membre)
                ->setSeance($seances ? $seances[$index % count($seances)] : null);
            $manager->persist($amende);
        }
        $manager->flush();
    }
}
