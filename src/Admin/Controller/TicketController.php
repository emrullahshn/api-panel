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
        $fields = $request->request;
    }

    /**
     * @Route("/all-tickets", name="all_tickets")
     * @return Response
     */
    public function getAllTickets()
    {
        return $this->render('all-tickets.html.twig');
    }

    /**
     * @Route("/view-ticket/{number}", name="view_ticket")
     * @return Response
     */
    public function viewTicket($number)
    {
        return $this->render('answer-ticket.html.twig');
    }
}
