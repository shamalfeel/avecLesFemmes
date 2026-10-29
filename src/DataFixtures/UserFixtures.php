<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Groupement;
use App\Entity\MembreSimple;
use App\Entity\Tresorier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['users']; }

    public function getDependencies(): array { return [GroupementFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $groupements = $manager->getRepository(Groupement::class)->findAll();
        if (!$groupements) {
            throw new \RuntimeException('Aucun groupement trouvé. Charge d’abord les fixtures de Groupement.');
        }

        $membres = [
            ['nom' => 'Aminata Ndiaye', 'tel' => '770000001', 'login' => 'membre1'],
            ['nom' => 'Fatou Diop', 'tel' => '770000002', 'login' => 'membre2'],
            ['nom' => 'Awa Fall', 'tel' => '770000003', 'login' => 'membre3'],
            ['nom' => 'Mariama Sow', 'tel' => '770000004', 'login' => 'membre4'],
            ['nom' => 'Khady Ba', 'tel' => '770000005', 'login' => 'membre5'],
        ];
        foreach ($membres as $index => $donnees) {
            $membre = new MembreSimple();
            $membre->setNomComplet($donnees['nom'])
                ->setTel($donnees['tel'])->setAdresse('Dakar')
                ->setLogin($donnees['login'])
                ->setPassword(password_hash('password123', PASSWORD_DEFAULT))
                ->setGroupement($groupements[$index % count($groupements)]);
            $manager->persist($membre);
        }

        $tresorier = new Tresorier();
        $tresorier->setNomComplet('Mamadou Fall')->setTel('771111111')
            ->setAdresse('Dakar')->setLogin('tresorier')
            ->setPassword(password_hash('password123', PASSWORD_DEFAULT))
            ->setGroupement($groupements[0]);
        $manager->persist($tresorier);

        $admin = new Admin();
        $admin->setNomComplet('Admin Principal')->setTel('772222222')
            ->setAdresse('Dakar')->setLogin('admin')
            ->setPassword(password_hash('password123', PASSWORD_DEFAULT))
            ->setGroupement($groupements[0]);
        $manager->persist($admin);
        $manager->flush();
    }
}
