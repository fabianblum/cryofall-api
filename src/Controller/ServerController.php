<?php

namespace App\Controller;

use App\Entity\Server;
use App\Repository\ServerRepository;
use App\Service\KillService;
use DateTime;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class ServerController extends AbstractFOSRestController
{
    public function __construct(private KillService $killService)
    {
    }

    private function validateDate($date): bool
    {
        try {
            new DateTime($date);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @Route("/server/{guid}/player_online", methods={"GET"})
     * @OA\Get(operationId="getOnlineAction")
     * @OA\Response(
     *     response=200,
     *     description="Returns the online player count",
     *     @Model(type=App\Model\Response\Server\PlayerOnlineResponse::class)
     * )
     * @OA\Parameter(
     *     name="guid",
     *     in="path",
     *     description="The Server GUID",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="server")
     *
     * @param string $guid
     * @return JsonResponse
     */
    public function getOnlineAction(string $guid): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(Server::class);

        /** @var Server $server */
        $server = $repository->findOneBy(['guid' => $guid]);

        if (null === $server) {
            return new JsonResponse(['error' => 'Server not found'], 404);
        }

        return new JsonResponse(['player_online' => $server->getPlayerOnline()]);
    }

    /**
     * @Route("/server/{guid}/leaderboard", methods={"GET"})
     * @OA\Get(operationId="getLeaderboardAction")
     * @OA\Response(
     *     response=200,
     *     description="Returns the online player count",
     *     @Model(type=App\Model\Response\Server\LeaderboardResponse::class)
     * )
     * @OA\Parameter(
     *     name="guid",
     *     in="path",
     *     description="The Server GUID",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="from",
     *     in="query",
     *     description="Filter date from, format: 2004-02-12T15:19:21+00:00",
     *     required=false,
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Parameter(
     *     name="to",
     *     in="query",
     *     description="Filter date to, format: 2004-02-12T15:19:21+00:00",
     *     required=false,
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="server")
     *
     * @param Request $request
     * @param string $guid
     * @return JsonResponse
     * @throws Exception
     */
    public function getLeaderboardAction(Request $request, string $guid): JsonResponse
    {
        /** @var ServerRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Server::class);
        $server = $repository->findOneBy(['guid' => $guid]);

        if (null === $server) {
            return new JsonResponse(['error' => 'Server not found'], 404);
        }

        $from = $request->query->get('from');
        $to = $request->query->get('to');

        if ($from) {
            if (!$this->validateDate($from)) {
                return new JsonResponse(
                    ['error' => '\'from\' is wrong formatted. Expected: 2004-02-12T15:19:21+00:00 given ' . $from],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $from = new DateTime($from);
        }

        if ($to) {
            if (!$this->validateDate($to)) {
                return new JsonResponse(
                    ['error' => '\'to\' is wrong formatted. Expected: 2004-02-12T15:19:21+00:00 given ' . $to],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $to = new DateTime($to);
        }

        $pvpLeaderboard = $this->killService->getPvpKillStatistics($server, $from, $to);
        $pveLeaderboard = $this->killService->getPveKillStatistics($server, $from, $to);

        return new JsonResponse(['pvp' => $pvpLeaderboard->asArray(), 'pve' => $pveLeaderboard->asArray()]);
    }

}