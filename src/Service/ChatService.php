<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Chat;
use App\Entity\Player;
use App\Entity\Server;
use App\Repository\ChatRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class ChatService
{
    private EntityManagerInterface $objectManager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create(Server $server, int $chatId, Player $fromPlayer, string $message): Chat
    {
        $chat = new Chat();
        $chat->setServer($server);
        $chat->setChatId($chatId);
        $chat->setFromPlayer($fromPlayer);
        $chat->setMessage($message);

        $this->objectManager->persist($chat);
        $this->objectManager->flush();


        return $chat;
    }
}