<?php

namespace App\App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     * @param TokenStorageInterface $tokenStorage
     * @return Response
     */
    public function profileAction(TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();

        return $this->render('profile-edit.html.twig', [
            'user' => $user
        ]);
    }
}
