<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie/{id}", name="movie", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(int $id): Response
    {
        //return new Response('Vous êtes sur le film' . $id);


        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);

    }
}
