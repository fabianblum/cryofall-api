<?php
namespace App\Controller;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/statistics", name="statistics_")
 */
class StatisticController extends AbstractFOSRestController
{
    /**
     * Lists all Movies.
     * @Rest\Get("/movies")
     *
     * @return Response
     */
    public function getMovieAction()
    {
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repository->findall();
        return $this->handleView($this->view($movies));
    }
    /**
     * Create Movie.
     * @Rest\Post("/movie")
     *
     * @return Response
     */
    public function postMovieAction(Request $request)
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }
}