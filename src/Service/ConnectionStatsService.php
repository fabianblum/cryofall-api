<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\ConnectionStats;
use App\Entity\IpGeo;
use Doctrine\ORM\EntityManagerInterface;

class ConnectionStatsService
{
    private EntityManagerInterface $objectManager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create(IpGeo $ipGeo, int $ping, int $pingAvg, int $fluctuation, int $jitter): ConnectionStats
    {
        $connectionStats = new ConnectionStats();
        $connectionStats->setIp($ipGeo);
        $connectionStats->setPing($ping);
        $connectionStats->setPingAvg($pingAvg);
        $connectionStats->setFluctuation($fluctuation);
        $connectionStats->setJitter($jitter);

        $this->objectManager->persist($connectionStats);
        $this->objectManager->flush();

        return $connectionStats;
    }
}