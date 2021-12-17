<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dislikes;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, inversedBy="restaurant", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=Coworker::class, inversedBy="restaurants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coworker;

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    static public function fromGoogleMaps(array $restaurantInfo)
    {
        $restaurant = new self();
        $restaurant
            ->setName($restaurantInfo['name'])
            ->setAddress(Address::fromGoogleMaps($restaurantInfo['formatted_address']))
            ->setDislikes(0)
            ->setLikes($restaurantInfo['user_ratings_total'])
        ;

        return $restaurant;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    public function setDislikes(?int $dislikes): self
    {
        $this->dislikes = $dislikes;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCoworker(): ?Coworker
    {
        return $this->coworker;
    }

    public function setCoworker(?Coworker $coworker): self
    {
        $this->coworker = $coworker;

        return $this;
    }
}
