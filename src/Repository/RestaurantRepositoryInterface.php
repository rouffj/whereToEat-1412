<?php

namespace App\Repository;

use App\Entity\Restaurant;

interface RestaurantRepositoryInterface
{
    public function findOneById($id): ?Restaurant;

    public function findAll();
}