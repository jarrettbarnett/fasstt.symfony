<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TicketsController extends Controller
{
    /**
     * @Route("/tickets")
     */
    public function IndexAction()
    {
        return $this->render('AppBundle:Tickets:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/ticket/{id}")
     */
    public function ViewAction($id)
    {
        return $this->render('AppBundle:Tickets:view.html.twig', array(
            // ...
        ));
    }

}
