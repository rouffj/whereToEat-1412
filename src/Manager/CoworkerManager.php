<?php

namespace App\Manager;

use App\Entity\Coworker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CoworkerManager
{
    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function register(Coworker $coworker)
    {
        $hashedPassword = $this->passwordHasher->hashPassword($coworker, $coworker->getPassword());
        $coworker->setPassword($hashedPassword);

        $this->entityManager->persist($coworker);
        $this->entityManager->flush();
    }
}
