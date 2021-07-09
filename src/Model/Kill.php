<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\Player;

class Kill
{
    public function __construct(private Player $player, private int $kills)
    {
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getKills(): int
    {
        return $this->kills;
    }
}
