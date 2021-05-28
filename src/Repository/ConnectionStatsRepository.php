<?php

namespace App\Repository;

use App\Entity\ConnectionStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConnectionStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnectionStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnectionStats[]    findAll()
 * @method ConnectionStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectionStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnectionStats::class);
    }

    // /**
    //  * @return ConnectionStats[] Returns an array of ConnectionStats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConnectionStats
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
