<?php

namespace App;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepositoryInterface;

class RestaurantFinder
{
    private $restaurantRepository;

    public function __construct(RestaurantRepositoryInterface $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function random(): Restaurant
    {
        $restaurants = $this->restaurantRepository->findAll();
        $key = array_rand($restaurants);

        return $restaurants[$key];
    }

    public function notTried(): Restaurant
    {
        throw new \LogicException('TODO, please implement this feature');
    }
}
