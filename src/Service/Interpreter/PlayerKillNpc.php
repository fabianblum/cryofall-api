<?php

namespace App\Service\Interpreter;

use App\Entity\EntityInterface;
use App\Entity\Kills;
use App\Service\NpcService;
use App\Service\PlayerService;

class PlayerKillNpc extends AbstractRegexInterpreter
{

    private string $entity = Kills::class;
    private NpcService $npcService;
    private PlayerService $playerService;

    public function __construct(NpcService $npcService, PlayerService $playerService)
    {
        $this->npcService = $npcService;
        $this->playerService = $playerService;
    }

    public function getRegex(): string
    {
        return '/Character \\"([^"]+)\\" \\(Id\\=([0-9]+)\\) by Character \\"PlayerCharacter\\" \\(\\"([^"]+)\\", Id=([0-9]+)\\)/';
    }

    /**
     * @return Kills
     */
    public function getEntity(): EntityInterface
    {
        return new $this->entity;
    }

    protected function buildEntity(iterable $matches): Kills
    {
        $entity = $this->getEntity();

        $npcName = $matches[1];
        $npcId = $matches[2];
        $playerName = $matches[3];
        $playerId = $matches[4];

        $npc = $this->npcService->getOrCreate($npcName, $npcId);
        $player = $this->playerService->getOrCreate($playerName);

        $entity->setKilledNpc($npc);
        $entity->setKillerPlayerUid($player);

        return $entity;
    }
}