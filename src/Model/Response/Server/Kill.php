<?php

namespace App\Model\Response\Server;

use OpenApi\Annotations as OA;

class Kill
{
    /**
     * @OA\Property(description="Name of the player")
     * @var string
     */
    private string $player;

    /**
     * @OA\Property(description="Kills of the player")
     * @var int
     */
    private int $kills;

    public function __construct(string $player, int $kills)
    {
        $this->player = $player;
        $this->kills = $kills;
    }

}