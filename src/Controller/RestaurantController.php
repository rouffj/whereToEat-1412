<?php

namespace App\Controller;

#use App\Repository\InMemoryRestaurantRepository;
#use App\Repository\RestaurantRepository;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepositoryInterface;
use App\RestaurantFinder;
use Doctrine\ORM\EntityManagerInterface;
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

    public function __construct(RestaurantRepositoryInterface $restaurantRepository)
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
     * @Route("/restaurant-finder/{strategy}", name="randomize", requirements={"strategy": "random|notTried"})
     */
    public function randomize(string $strategy, RestaurantFinder $finder)
    {
        $restaurant = $finder->$strategy();

        // return $this->redirectToRoute('restaurant_show', 
        //     ['id' => $restaurant->getId()]
        // );
        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
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

    /**
     * @Route("/restaurant/{id}/vote/{type}", name="vote")
     */
    public function vote($type, Restaurant $restaurant, EntityManagerInterface $entityManager)
    {
        //@TODO ce code doit être mis dans un service métier.
        if ($type == 1) {
            $restaurant->setLikes($restaurant->getLikes()+1);
            $this->addFlash('success', 'Your like has been saved');
        } else {
            $restaurant->setDislikes($restaurant->getDislikes()+1);
            $this->addFlash('warning', 'Your dislike has been saved');
        }

        $entityManager->flush();

        return $this->redirectToRoute('restaurant_show', ['id' => $restaurant->getId()]);
    }
}
