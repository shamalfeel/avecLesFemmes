<?php

namespace App\Repository;

use App\Entity\Groupement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\GroupeSearchDto;
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

     public function save(Groupement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Groupement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllGroupementsAndExercicesEncours(GroupeSearchDto $searchDto): array
    {
        // SELECT * FROM groupement g LEFT JOIN execice e ON g.id = e.groupement_id WHERE e.statut = 'en_cours'
        $qb = $this->createQueryBuilder('g')
            ->leftJoin('g.exercices', 'e')
            ->addSelect('e')
            ->where('e.status = :status')
            ->setParameter('status', 'en_cours');

        if ($searchDto->valeur) {
            $qb->andWhere('g.nom LIKE :valeur OR g.adresse LIKE :valeur')
                ->setParameter('valeur', '%' . $searchDto->valeur . '%');
        }

        return $qb->getQuery()->getResult();
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
