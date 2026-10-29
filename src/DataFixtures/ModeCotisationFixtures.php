<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\ModeCotisation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModeCotisationFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['mode_cotisations']; }
    public function getDependencies(): array { return [CampagneFixtures::class, UserFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $campagnes = $manager->getRepository(Campagne::class)->findAll();
        $membres = $manager->getRepository(User::class)->findAll();
        foreach ($membres as $index => $membre) {
            foreach ($campagnes as $campagne) {
                $mode = new ModeCotisation();
                $mode->setIsLibre($index % 2 === 0)->setCampagne($campagne)->setMembre($membre);
                $manager->persist($mode);
            }
        }
        $manager->flush();
    }
}
