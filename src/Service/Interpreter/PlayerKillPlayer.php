<?php
declare(strict_types=1);

namespace App\Service\Interpreter;

use App\Entity\EntityInterface;
use App\Entity\Kills;
use App\Service\NpcService;
use App\Service\PlayerService;

class PlayerKillPlayer extends AbstractRegexInterpreter
{
    private PlayerService $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function getRegex(): string
    {
        return '/Character \"PlayerCharacter\" \(\"([^"]+)\", Id\=([0-9]+)\) by Character \"PlayerCharacter\" \(\"([^"]+)\", Id=([0-9]+)\)/';
    }

    protected function buildEntity(iterable $matches): Kills
    {
        $entity = new Kills();

        $killedPlayerName = $matches[1];
        $killedPlayerUid = $matches[2];
        $playerName = $matches[3];
        $playerId = $matches[4];

        $player = $this->playerService->getOrCreate($playerName);
        $killedPlayer = $this->playerService->getOrCreate($killedPlayerName);

        $entity->setKilledPlayerUid($killedPlayer);
        $entity->setKillerPlayerUid($player);

        return $entity;
    }
}