<?php

namespace App\Service;

use App\Entity\Server;
use App\Repository\ServerRepository;
use Doctrine\Persistence\ObjectManager;

class ServerService
{
    private ObjectManager $objectManager;
    private ServerRepository $serverRepository;

    public function __construct(ServerRepository $serverRepository, ObjectManager $objectManager)
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