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
    public function renderTemplate($actionName, $templatePath, array $parameters = []): ?Response
    {
        if ($actionName === 'edit') {
            return $this->render('bundles/EasyAdminBundle/Ticket/edit.html.twig', $parameters);
        }

        return $this->render('@EasyAdminExtension/default/list.html.twig', $parameters);
    }

    /**
     * @Route(path="/post-ticket", name="post_ticket", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TokenStorageInterface $tokenStorage
     * @param string $uploadDir
     * @return JsonResponse
     */
    public function createNewTicket(Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage, string $uploadDir): JsonResponse
    {
        $department = $request->request->get('department');
        $subject = $request->request->get('subject');
        $content = $request->request->get('detail');
        $files = $request->files->get('file');


        $filePaths = [];
        foreach ($files as $file){
            $fileName = md5(uniqid(rand(), true)).'.'.$file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $filePaths[] = $uploadDir.'/'.$fileName;
        }

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
            ->setImageRaw($filePaths)
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

        return $this->render('all-tickets.html.twig', [
            'create' => $isCreate,
            'tickets' => $user->getTickets()
        ]);
    }

    /**
     * @Route("/view-ticket/{number}", name="view_ticket")
     * @param $number
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function viewTicket($number, EntityManagerInterface $entityManager): Response
    {
        $ticketRepo = $entityManager->getRepository(Ticket::class);
        $ticket = $ticketRepo->find($number);

        return $this->render('answer-ticket.html.twig', [
            'ticket' => $ticket
        ]);
    }

    /**
     * @Route(path="/add-ticket-message", name="add_ticket_message", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function addTicketMessage(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $ticketId = (int)$request->request->get('ticketId');
        $message = $request->request->get('replyContent');
        $status = $request->request->get('status');

        $ticketRepo = $entityManager->getRepository(Ticket::class);
        $ticket = $ticketRepo->find($ticketId);

        $lastOrderIndex = $ticket->getMessages()->last()->getOrderIndex();

        $ticketMessage = (new TicketMessage())
            ->setMessage($message)
            ->setTicket($ticket)
            ->setStatus($status)
            ->setOrderIndex(++$lastOrderIndex);

        $ticket->addMessage($ticketMessage);
        $ticket->setStatus(Ticket::STATUS_ANSWERED);

        $entityManager->persist($ticketMessage);
        $entityManager->flush();

        return new JsonResponse([
            'message' => $message
        ]);
    }

    /**
     * @Route(path="/close-ticket", name="close_ticket", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function closeTicket(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $ticketId = (int)$request->request->get('ticketId');
        $ticketRepo = $entityManager->getRepository(Ticket::class);
        $ticket = $ticketRepo->find($ticketId);
        $ticket->setStatus(Ticket::STATUS_CLOSED);
        $entityManager->flush();

        return new JsonResponse([
            'status' => true
        ]);
    }
}
