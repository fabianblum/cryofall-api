<?php

namespace App\Repository;

use App\Entity\Kills;
use App\Entity\Server;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kills|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kills|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kills[]    findAll()
 * @method Kills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kills::class);
    }

    public function getPvpStatistics(Server $server, DateTime $from = null, DateTime $to = null, int $limit = null): mixed
    {
        $qb = $this->createQueryBuilder('k')
            ->addSelect('COUNT(k.id) as kills')
            ->where('k.server = :server')
            ->andWhere('k.killerPlayerUid IS NOT NULL')
            ->andWhere('k.killedPlayerUid IS NOT NULL')
            ->setParameter('server', $server)
            ->orderBy('kills', 'DESC')
            ->groupBy('k.killerPlayerUid');

        if ($from) {
            $qb->andWhere('k.datetime >= :from')
                ->setParameter('from', $from->format("Y-m-d H:i:s"));
        }

        if ($to) {
            $qb->andWhere('k.datetime < :to')
                ->setParameter('to', $to->format("Y-m-d H:i:s"));
        }

        if($limit) {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function getPveStatistics(Server $server, DateTime $from = null, DateTime $to = null, int $limit = null): mixed
    {
        $qb = $this->createQueryBuilder('k')
            ->addSelect('COUNT(k.id) as kills')
            ->where('k.server = :server')
            ->andWhere('k.killerPlayerUid IS NOT NULL')
            ->andWhere('k.killedPlayerUid IS NULL')
            ->setParameter('server', $server)
            ->orderBy('kills', 'DESC')
            ->groupBy('k.killerPlayerUid');

        if ($from) {
            $qb->andWhere('k.datetime >= :from')
                ->setParameter('from', $from->format("Y-m-d H:i:s"));
        }

        if ($to) {
            $qb->andWhere('k.datetime < :to')
                ->setParameter('to', $to->format("Y-m-d H:i:s"));
        }

        if($limit) {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();

        return $query->execute();
    }

    // /**
    //  * @return Kills[] Returns an array of Kills objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kills
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
