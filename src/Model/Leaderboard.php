<?php

declare(strict_types=1);

namespace App\Model;

class Leaderboard
{
    /**
     * @param Kill[] $kills
     */
    public function __construct(private array $kills)
    {
    }

    public function asArray(): array
    {
        $ret = [];
        foreach ($this->kills as $kill) {
            $ret[] = ["player" => $kill->getPlayer()->getName(), "kills" => $kill->getKills()];
        }

        return $ret;
    }
}
