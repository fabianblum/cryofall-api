<?php

namespace App\Repository;

use App\Entity\CommandQueue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandQueue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandQueue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandQueue[]    findAll()
 * @method CommandQueue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandQueueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandQueue::class);
    }

    // /**
    //  * @return CommandQueue[] Returns an array of CommandQueue objects
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
    public function findOneBySomeField($value): ?CommandQueue
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
