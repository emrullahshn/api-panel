<?php

namespace App\Admin\Controller;

use App\Admin\Entity\Ticket;
use App\Admin\Entity\TicketMessage;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TicketController extends EasyAdminController
{
    /**
     * @Route(path="/post-ticket", name="post_ticket", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function createNewTicket(Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): JsonResponse
    {
        $department = $request->request->get('department');
        $subject = $request->request->get('subject');
        $content = $request->request->get('detail');
//        $file = $request->files->all()['file'];

        $user = $tokenStorage->getToken()->getUser();

        $ticket = (new Ticket())
            ->setDepartment($department)
            ->setSubject($subject)
            ->setStatus(Ticket::STATUS_NEW)
            ->setUser($user)
        ;

        $ticketMessage = (new TicketMessage())
            ->setMessage($content)
            ->setOrderIndex(1)
            ->setStatus(TicketMessage::STATUS_USER)
            ->setTicket($ticket)
        ;

        $ticket->addMessage($ticketMessage);

        $entityManager->persist($ticket);
        $entityManager->persist($ticketMessage);
        $entityManager->flush();

        return new JsonResponse([
            'status' => true
        ]);
    }

    /**
     * @Route("/all-tickets", name="all_tickets")
     * @param Request $request
     * @param TokenStorageInterface $tokenStorage
     * @return Response
     */
    public function getAllTickets(Request $request, TokenStorageInterface $tokenStorage): Response
    {
        $isCreate = $request->query->get('create');
        $user = $tokenStorage->getToken()->getUser();
        $tickets = $user->getTickets();


        return $this->render('all-tickets.html.twig', [
            'create' => $isCreate,
            'tickets' => $user->getTickets()
        ]);
    }

    /**
     * @Route("/view-ticket/{number}", name="view_ticket")
     * @param $number
     * @return Response
     */
    public function viewTicket($number): Response
    {
        return $this->render('answer-ticket.html.twig');
    }
}
