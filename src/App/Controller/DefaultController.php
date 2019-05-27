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
    public function indexAction()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/invoice", name="invoice")
     * @return Response
     */
    public function invoinceAction()
    {
        return $this->render('invoice.html.twig');
    }

    /**
     * @Route("/add-balance", name="add_balance_page")
     * @return Response
     */
    public function addBalanceAction()
    {
        return $this->render('add-balance.html.twig');
    }

    /**
     * @Route("/add-credit-card-page", name="add_credit_card_page")
     * @return Response
     */
    public function addCreditCardAction()
    {
        return $this->render('add-credit-card.html.twig');
    }

    /**
     * @Route("/destek-talebi", name="destek_talebi")
     * @return Response
     */
    public function createTicket()
    {
        return $this->render('create-ticket.html.twig');
    }
}
