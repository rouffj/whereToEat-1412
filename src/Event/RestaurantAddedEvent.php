<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\Restaurant;
use App\Entity\Coworker;

class RestaurantAddedEvent extends Event
{
    private $restaurant;
    private $coworker;

    public function __construct(Restaurant $restaurant, Coworker $coworker)
    {
        $this->restaurant =  $restaurant;
        $this->coworker =  $coworker;
    }

    public function getRestaurant(): Restaurant
    {
        return $this->restaurant;
    }
    public function getCoworker(): Coworker
    {
        return $this->coworker;
    }
}