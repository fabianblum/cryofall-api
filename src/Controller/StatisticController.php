<?php
namespace App\Controller;
use App\Entity\CommandQueue;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Route("/statistics", name="statistics_")
 */
class StatisticController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/commands")
     *
     * @return Response
     */
    public function getCommandsAction()
    {
        $repository = $this->getDoctrine()->getRepository(CommandQueue::class);
        //$commands = $repository->findBy(['server_id' => ]);
        //return $this->handleView($this->view($movies));
    }

}