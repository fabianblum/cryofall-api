<?php

namespace App\Repository;

use App\Entity\IpGeo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IpGeo|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpGeo|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpGeo[]    findAll()
 * @method IpGeo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpGeoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpGeo::class);
    }

    // /**
    //  * @return IpGeo[] Returns an array of IpGeo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IpGeo
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
