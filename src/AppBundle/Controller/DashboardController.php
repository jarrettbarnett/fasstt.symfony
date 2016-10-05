<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function IndexAction()
    {
        $issues = $this->getDoctrine()->getRepository('AppBundle:Issue')->findAll();

        $viewData = [
            'issues' => $issues,
            'pageTitle' => 'Dashboard: All Project Issues'
        ];
        return $this->render('dashboard/index.html.twig', $viewData);
    }
}
