<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("", methods={"GET"}, name="restaurant_")
 */
class RestaurantController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function index(): Response
    {
        return $this->render('restaurant/index.html.twig');
    }

    /**
     * @Route("/restaurant/{id}", name="show", requirements={"id": "\d+"})
     */
    public function show(int $id)
    {
        return $this->render('restaurant/show.html.twig', [
        ]);
    }
}
