<?php

namespace App\DataFixtures;

use App\Entity\Groupement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class GroupementFixtures extends Fixture implements FixtureGroupInterface
{   public static function getGroups(): array
{
    return ['groupements'];
}
    public function load(ObjectManager $manager): void
    {
        $groupements = [
            [
                'nom' => 'Teranga',
                'tel' => '771234567',
                'adresse' => 'Dakar',
            ],
            [
                'nom' => 'Solidarite',
                'tel' => '761234567',
                'adresse' => 'Thies',
            ],
            [
                'nom' => 'Entraide',
                'tel' => '781234567',
                'adresse' => 'Saint-Louis',
            ],
        ];

        foreach ($groupements as $donnees) {
            $groupement = new Groupement();

            $groupement
                ->setNom($donnees['nom'])
                ->setTel($donnees['tel'])
                ->setAdresse($donnees['adresse'])
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($groupement);
        }

        $manager->flush();
    }
}