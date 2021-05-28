<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\InterpreterService;
use App\Service\ServerService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/raw", name="raw_")
 */
class TokenController extends AbstractFOSRestController
{

    /**
     * @Rest\Post("/line")
     *
     * @param Request $request
     * @return Response
     */
    public function postRawString(Request $request): Response
    {
        $content = json_decode($request->getContent(), true);

        if (false === $content) {
            throw new HttpException(500, "Missing content string");
        }

        $server = $this->serverService->getOrCreate($content['GUID']);

        $interpreter = new InterpreterService();

        try {
            $interpreter->interpretLine($server, $content['line']);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }

        $view = $this->view([], 200);

        return $this->handleView($view);
    }

}