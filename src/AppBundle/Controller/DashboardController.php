<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function IndexAction()
    {
        $data = [
            'test' => 'testdata',
            'test2' => [
                'test3' => 'test3data'
            ],
            'pageTitle' => 'Dashboard > All Issues'
        ];
        return $this->render('dashboard/index.html.twig', $data);
    }
}
