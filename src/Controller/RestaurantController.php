<?php

namespace App\Controller;

use App\Repository\InMemoryRestaurantRepository;
use App\Repository\RestaurantRepository;
use ProxyManager\ProxyGenerator\ValueHolder\MethodGenerator\Constructor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("", methods={"GET"}, name="restaurant_")
 */
class RestaurantController extends AbstractController
{
    private $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepository)
    {
        //$this->restaurantRepository = new InMemoryRestaurantRepository();
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @Route("/", name="list")
     */
    public function index(): Response
    {
        $restaurants = $this->restaurantRepository->findAll();
        #dump($restaurants);die;

        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * @Route("/restaurant/{id}", name="show", requirements={"id": "\d+"})
     */
    public function show(int $id)
    {
        $restaurant = $this->restaurantRepository->findOneById($id);

        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }
}
