<?php

namespace App\Service;

use App\Entity\Npc;
use App\Entity\Player;
use App\Repository\NpcRepository;
use App\Repository\PlayerRepository;
use Doctrine\Persistence\ObjectManager;

class PlayerService
{
    private ObjectManager $objectManager;
    private PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository, ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->playerRepository = $playerRepository;
    }

    public function getOrCreate(string $name): Player
    {
        $player = $this->playerRepository->findOneBy(['name' => $name]);

        if (null === $player) {
            $player = new Player();
            $player->setName($name);

            $this->objectManager->persist($player);
            $this->objectManager->flush();
        }

        return $player;
    }
}