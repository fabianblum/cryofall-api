<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayerService
{
    private EntityManagerInterface $objectManager;
    private PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $objectManager)
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