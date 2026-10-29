<?php

namespace App\DataFixtures;

use App\Entity\Pret;
use App\Entity\Remboursement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RemboursementFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array { return ['remboursements']; }
    public function getDependencies(): array { return [PretFixtures::class]; }

    public function load(ObjectManager $manager): void
    {
        $prets = $manager->getRepository(Pret::class)->findAll();
        foreach ($prets as $pret) {
            if (!$pret->isPaid()) { continue; }
            $remboursement = new Remboursement();
            $remboursement->setDatePaiement(new \DateTimeImmutable('2026-06-15'))
                ->setMontant($pret->getMontant())->setPret($pret);
            $manager->persist($remboursement);
        }
        $manager->flush();
    }
}
