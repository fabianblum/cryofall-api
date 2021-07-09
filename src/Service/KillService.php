<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Player;
use App\Entity\Server;
use App\Model\Kill;
use App\Model\Leaderboard;
use App\Repository\KillsRepository;
use DateTime;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;

class KillService
{
    private KillsRepository $killsRepository;

    public function __construct(KillsRepository $killsRepository)
    {
        $this->killsRepository = $killsRepository;
    }

    /**
     * @param Server $server
     * @param DateTime|null $from
     * @param DateTime|null $to
     * @return LazyCriteriaCollection
     */
    public function getKills(Server $server, DateTime $from = null, DateTime $to = null): LazyCriteriaCollection
    {
        $criteria = Criteria::create();
        $criteria->andWhere(Criteria::expr()->eq('server', $server));


        if ($from) {
            $criteria->andWhere(Criteria::expr()->gte('datetime', $from));
        }
        if ($to) {
            $criteria->andWhere(Criteria::expr()->lt('datetime', $to));
        }

        return $this->killsRepository->matching($criteria);
    }

    /**
     * @param Server $server
     * @param DateTime|null $from
     * @param DateTime|null $to
     * @param int|null $limit
     * @return Leaderboard
     */
    public function getPvpKillStatistics(Server $server, ?DateTime $from = null, ?DateTime $to = null, int $limit = null): Leaderboard
    {
        $killStatistic = [];
        foreach ($this->killsRepository->getPvpStatistics($server, $from, $to, $limit) as $kill) {
            /** @var Player $killer */
            $killer = $kill[0]->getKillerPlayerUid();
            $killStatistic[] = new Kill($killer, $kill['kills']);
        }

        return new Leaderboard($killStatistic);
    }

    /**
     * @param Server $server
     * @param DateTime|null $from
     * @param DateTime|null $to
     * @param int|null $limit
     * @return Leaderboard
     */
    public function getPveKillStatistics(Server $server, DateTime $from = null, DateTime $to = null, int $limit = null): Leaderboard
    {
        $killStatistic = [];
        foreach ($this->killsRepository->getPveStatistics($server, $from, $to, $limit) as $kill) {
            /** @var Player $killer */
            $killer = $kill[0]->getKillerPlayerUid();
            $killStatistic[] = new Kill($killer, $kill['kills']);
        }

        return new Leaderboard($killStatistic);
    }
}