<?php

namespace App\Controller;

use App\Entity\Coworker;
use App\Form\CoworkerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

/**
 * firstName, lastName, password, email, terms
 * 
 * @Route("", name="coworker_")
 */
class CoworkerController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->container->get('doctrine');
        $registerForm = $this->createForm(CoworkerType::class);
        $registerForm->add('register', Type\SubmitType::class);

        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $entityManager = $doctrine->getManager();
            /** @var Coworker */
            $coworker = $registerForm->getData();
            $entityManager->persist($coworker);
            $entityManager->flush();
            dump($coworker);
            $this->addFlash('success', 'You have successfully created your account :)');

            return $this->redirectToRoute('coworker_login');
            // Insert into DB
        }

        return $this->render('coworker/register.html.twig', [
            'register_form' => $registerForm->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('coworker/login.html.twig');
    }
}
