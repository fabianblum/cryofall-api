<?php

namespace App\Controller;

use App\Service\InterpreterService;
use App\Service\ServerService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @Route("/raw", name="raw_")
 */
class RawController extends AbstractFOSRestController
{
    private ServerService $serverService;

    public function __construct(ServerService $serverService)
    {
        $this->serverService = $serverService;
    }

    /**
     * @Rest\Post("/line")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function postRawString(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);

        if (false === $content) {
            throw new HttpException(500, "Missing content string");
        }

        $server = $this->serverService->getOrCreate($content['GUID']);

        $interpreter = new InterpreterService();
        $interpreter->interpretLine($server, $content['line']);

        return new JsonResponse();
    }
}