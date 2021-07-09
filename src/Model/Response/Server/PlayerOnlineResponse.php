<?php

namespace App\Model\Response\Server;

use App\Model\Response\AbstractResponse;
use OpenApi\Annotations as OA;

class PlayerOnlineResponse extends AbstractResponse
{
    /**
     * @OA\Property(description="The online player count")
     * @var int
     */
    private int $playerOnline;

    public function __construct(int $playerOnline)
    {
        $this->playerOnline = $playerOnline;
    }
}