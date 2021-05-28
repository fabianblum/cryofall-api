<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Server;
use App\Repository\ServerRepository;
use Doctrine\ORM\EntityManagerInterface;

class ServerService
{
    private EntityManagerInterface $objectManager;
    private ServerRepository $serverRepository;

    public function __construct(ServerRepository $serverRepository, EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->serverRepository = $serverRepository;
    }

    public function getOrCreate(string $guid, string $name = null, $playerOnline = 0): Server
    {
        $server = $this->serverRepository->findOneBy(['guid' => $guid]);

        if (null === $server) {
            $server = new Server();
            $server->setGuid($guid);
            $server->setName($name);
            $this->objectManager->persist($server);
            $this->objectManager->flush();
        }

        return $server;
    }
}