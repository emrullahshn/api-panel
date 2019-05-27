<?php

namespace App\Admin\Controller;

use App\Admin\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends EasyAdminController
{
    /**
     * @Route(path="/post-ticket", name="post_ticket", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function createNewTicket(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $department = $request->request->get('departman');
        $subject = $request->request->get('subject');
        $content = $request->request->get('detail');

        $file = $request->files->all()['file'];

        $ticket = (new Ticket())
            ->setDepartment($department)
            ->setSubject($subject)
            ->setContent($content)
            ->setStatus(Ticket::STATUS_NEW);

        $entityManager->persist($ticket);
        $entityManager->flush();

        return new JsonResponse([
            'status' => true
        ]);
    }

    /**
     * @Route("/all-tickets", name="all_tickets")
     * @param Request $request
     * @return Response
     */
    public function getAllTickets(Request $request): Response
    {
        $isCreate = $request->query->get('create');

        return $this->render('all-tickets.html.twig',['create' => $isCreate]);
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
