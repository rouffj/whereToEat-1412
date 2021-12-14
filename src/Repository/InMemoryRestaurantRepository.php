<?php

namespace App\Repository;

use App\Entity\Restaurant;
use App\Entity\Address;

class InMemoryRestaurantRepository
{
    public function findOneById($id): ?Restaurant
    {
        $restaurants = array_filter($this->findAll(), function(Restaurant $restaurant) use ($id) {
            return $restaurant->getId() == $id;
        });

        // Return the first restaurant only
        return reset($restaurants);
    }

    public function findAll(): array
    {
        /*
        $r1 = new Restaurant(1);
        $r1
            ->setName('Le P’tit B')
            ->setLikes(5)
            ->setDislikes(1);

        $r2 = new Restaurant(2);
        $r2
            ->setName('Wok Addict')
            ->setLikes(25)
            ->setDislikes(2);

        $r3 = new Restaurant(3);
        $r3
            ->setName('231 East Street')
            ->setLikes(12)
            ->setDislikes(3);

        $addr1 = new Address();
        $addr1
            ->setStreet('15 Rue du Vaugueux')
            ->setZipCode('14000')
            ->setCity('Caen');

        $addr2 = new Address();
        $addr2
            ->setStreet('91 rue de la Victoire')
            ->setZipCode('75009')
            ->setCity('Paris');

        $addr3 = new Address();
        $addr3
            ->setStreet('2 Rue De La Pepiniere')
            ->setZipCode('75008')
            ->setCity('Paris');
            
        $r1->setAddress($addr1);
        $r2->setAddress($addr2);
        $r3->setAddress($addr3);

        return [$r1, $r2, $r3];
        */
        $r1 = new Restaurant(1);
        $r1
            ->setName('Les Petits Bonheurs')
            ->setLikes(5)
            ->setDislikes(1);

        $r2 = new Restaurant(2);
        $r2
            ->setName('Restaurant Osmoz')
            ->setLikes(25)
            ->setDislikes(2);

        $r3 = new Restaurant(3);
        $r3
            ->setName('La Pelle A Tarte')
            ->setLikes(12)
            ->setDislikes(3);

        $r4 = new Restaurant(4);
        $r4
            ->setName('Restaurant Le P’tit B')
            ->setLikes(25)
            ->setDislikes(0);

        $addr1 = new Address();
        $addr1
            ->setStreet('30 Place René Goblet')
            ->setZipCode('80000')
            ->setCity('Amien');

        $addr2 = new Address();
        $addr2
            ->setStreet('8 Rue Lamarck')
            ->setZipCode('80000')
            ->setCity('Amiens');

        $addr3 = new Address();
        $addr3
            ->setStreet('10 Rue Victor Hugo')
            ->setZipCode('80000')
            ->setCity('Amiens');

        $addr4 = new Address();
        $addr4
            ->setStreet('15 Rue du Vaugueux')
            ->setZipcode('14000')
            ->setCity('Caen');

        $r1->setAddress($addr1);
        $r2->setAddress($addr2);
        $r3->setAddress($addr3);
        $r4->setAddress($addr4);

        return [$r1, $r2, $r3, $r4];
    }
    }