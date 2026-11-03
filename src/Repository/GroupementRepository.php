<?php

namespace App\Repository;

use App\Entity\Groupement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Groupement>
 */
class GroupementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupement::class);
    }

     public function findAllWithExercices(): array
    {
        return $this->createQueryBuilder('g')
            ->leftJoin('g.exercices', 'e')
            ->addSelect('e')
            ->orderBy('g.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByVilleouNom(string $valeur): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.nom LIKE :valeur OR g.adresse LIKE :valeur')
            ->setParameter('valeur', '%' . $valeur . '%')
            ->getQuery()
            ->getResult();
    } 
//    /**
//     * @return Groupement[] Returns an array of Groupement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Groupement
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
