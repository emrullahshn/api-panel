<?php

namespace App\Admin\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends EasyAdminController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     * @return Response
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
}
