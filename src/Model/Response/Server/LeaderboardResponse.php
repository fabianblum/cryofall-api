<?php

namespace App\Model\Response\Server;

use App\Model\Response\AbstractResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class LeaderboardResponse extends AbstractResponse
{
    /**
     * @OA\Property(
     *      type="array",
     *      @OA\Items(
     *          ref=@Model(type=App\Model\Response\Server\Kill::class)
     *      )
     * )
     * @var Kill[]
     */
    private array $pvp;

    /**
     * @OA\Property(
     *      type="array",
     *      @OA\Items(
     *          ref=@Model(type=App\Model\Response\Server\Kill::class)
     *      )
     * )
     * @var Kill[]
     */
    private array $pve;

    /**
     * LeaderboardResponse constructor.
     * @param Kill[] $pvp
     * @param Kill[] $pve
     */
    public function __construct(array $pvp, array $pve)
    {
        $this->pvp = $pvp;
        $this->pve = $pve;
    }

}