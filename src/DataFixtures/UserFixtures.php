<?php

namespace App\DataFixtures;

use App\Entity\MembreSimple;
use App\Entity\Tresorier;
use App\Entity\Admin;
use App\Entity\Groupement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['users'];
    }

    public function load(ObjectManager $manager): void
    {
        $groupement = $manager->getRepository(Groupement::class)->findOneBy([]);

        if (!$groupement) {
            throw new \RuntimeException(
                'Aucun groupement trouvé. Charge d’abord les fixtures de Groupement.'
            );
        }

        // Membres simples
        for ($i = 1; $i <= 5; $i++) {
            $membre = new MembreSimple();
            $membre
                ->setNomComplet("Membre $i")
                ->setTel("77000000" . str_pad((string) $i, 1, '0', STR_PAD_LEFT))
                ->setAdresse('Dakar')
                ->setLogin("membre$i")
                ->setPassword(password_hash('password123', PASSWORD_DEFAULT))
                ->setGroupement($groupement);

            $manager->persist($membre);
        }

        // Trésorier
        $tresorier = new Tresorier();
        $tresorier
            ->setNomComplet('Mamadou Fall')
            ->setTel('771111111')
            ->setAdresse('Dakar')
            ->setLogin('tresorier')
            ->setPassword(password_hash('password123', PASSWORD_DEFAULT))
            ->setGroupement($groupement);

        $manager->persist($tresorier);

        // Administrateur
        $admin = new Admin();
        $admin
            ->setNomComplet('Admin Principal')
            ->setTel('772222222')
            ->setAdresse('Dakar')
            ->setLogin('admin')
            ->setPassword(password_hash('password123', PASSWORD_DEFAULT))
            ->setGroupement($groupement);

        $manager->persist($admin);

        $manager->flush();
    }
}