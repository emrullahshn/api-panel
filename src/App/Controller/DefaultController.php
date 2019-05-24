<?php

namespace App\App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @TODO
     * @Route("/login-page", name="login_page")
     * @return Response
     */
    public function loginPage()
    {
        return $this->render('login-page.html.twig');
    }

    /**
     * @TODO
     * @Route("/profile-edit", name="profile_edit")
     * @return Response
     */
    public function profileEdit()
    {
        return $this->render('profile-edit.html.twig');
    }
}
