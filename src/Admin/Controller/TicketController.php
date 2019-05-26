<?php

namespace App\Admin\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends EasyAdminController
{
    /**
     * @Route(path="/create-ticket", name="create_ticket", methods={"POST"})
     * @param Request $request
     */
    public function createTicket(Request $request){

    }

//    public function createTicketsEntityFormBuilder($entity, $view)
//    {
//    }
}
