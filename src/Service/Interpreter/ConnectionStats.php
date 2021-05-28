<?php
declare(strict_types=1);

namespace App\Service\Interpreter;

use App\Service\ConnectionStatsService;
use App\Service\IpGeoService;
use App\Service\PlayerService;

class ConnectionStats extends AbstractRegexInterpreter
{
    private PlayerService $playerService;
    private IpGeoService $ipGeoService;
    private ConnectionStatsService $connectionStatsService;

    public function __construct(
        IpGeoService $ipGeoService,
        PlayerService $playerService,
        ConnectionStatsService $connectionStatsService
    ) {
        $this->playerService = $playerService;
        $this->ipGeoService = $ipGeoService;
        $this->connectionStatsService = $connectionStatsService;
    }

    public function getRegex(): string
    {
        return '/\* ([^ ]+) \(ID=([0-9]+), IP=([^:]+)\:[0-9]+ UDP\): ping game=([0-9]+), ping avg=([0-9]+), fluctuation=([0-9]+), jitter=([0-9]+)/';
    }

    protected function buildEntity(iterable $matches): \App\Entity\ConnectionStats
    {
        $playerName = $matches[1];
        $playerId = $matches[2];
        $ip = $matches[3];
        $ping = (int)$matches[4];
        $pingAvg = (int)$matches[5];
        $fluctuation = (int)$matches[6];
        $jitter = (int)$matches[7];

        $ipGeo = $this->ipGeoService->getByIp($ip);

        if (null === $ipGeo) {
            $result = json_decode(
                file_get_contents("http://ip-api.com/json/$ip?fields=continentCode,countryCode,city"),
                true
            );
            $ipGeo = $this->ipGeoService->create(
                $ip,
                $result['city'],
                $result['countryCode'],
                $result['continentCode']
            );
        }

        $this->connectionStatsService->create($ipGeo, $ping, $pingAvg, $fluctuation, $jitter);
        $player = $this->playerService->getOrCreate($playerName);

        $connectionStats = new \App\Entity\ConnectionStats();
        $connectionStats->setPlayerUid($player);
        $connectionStats->setIp($ipGeo);
        $connectionStats->setPing($ping);
        $connectionStats->setPingAvg($pingAvg);
        $connectionStats->setJitter($jitter);
        $connectionStats->setFluctuation($fluctuation);

        return $connectionStats;
    }
}