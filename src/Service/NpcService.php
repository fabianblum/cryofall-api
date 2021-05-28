<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Npc;
use App\Repository\NpcRepository;
use Doctrine\ORM\EntityManagerInterface;

class NpcService
{
    private NpcRepository $npcRepository;
    private EntityManagerInterface $objectManager;

    public function __construct(NpcRepository $npcRepository, EntityManagerInterface $objectManager)
    {
        $this->npcRepository = $npcRepository;
        $this->objectManager = $objectManager;
    }

    public function getOrCreate(string $code, string $inGameId): Npc
    {
        $npc = $this->npcRepository->findOneBy(['code' => $code]);

        if (null === $npc) {
            $npc = new Npc();
            $npc->setCode($code);
            $npc->setInGameId($inGameId);
            $this->objectManager->persist($npc);
            $this->objectManager->flush();
        }

        return $npc;
    }
}