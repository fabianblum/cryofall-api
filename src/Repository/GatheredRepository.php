<?php

namespace App\Repository;

use App\Entity\Gathered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gathered|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gathered|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gathered[]    findAll()
 * @method Gathered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GatheredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gathered::class);
    }

    // /**
    //  * @return Gathered[] Returns an array of Gathered objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gathered
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
