<?php
declare(strict_types=1);

namespace App\Service\Interpreter;

use App\Service\ChatService;
use App\Service\PlayerService;
use App\Service\ServerService;

class Chat extends AbstractRegexInterpreter
{
    private PlayerService $playerService;

    public function __construct(
        PlayerService $playerService
    ) {
        $this->playerService = $playerService;
    }

    public function getRegex(): string
    {
        return '/ChatId=([0-9]+) From="[^"]+": (.*) Character "([^"]+)" \(Id=([0-9]+)\)/';
    }

    protected function buildEntity(iterable $matches): \App\Entity\Chat
    {
        $chatId = (int)$matches[1];
        $message = $matches[2];
        $playerName = $matches[3];
        $palyerId = (int)$matches[4];

        $player = $this->playerService->getOrCreate($playerName);

        $chat = new \App\Entity\Chat();
        $chat->setChatId($chatId);
        $chat->setFromPlayer($player);
        $chat->setMessage($message);

        return $chat;
    }
}