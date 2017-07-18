<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TicketsController extends Controller
{
    /**
     * @Route("/project/{projectId}/tickets", name="ticket_index")
     */
    public function IndexAction()
    {
        return $this->render('tickets/index.html.twig', array(
        
        ));
    }

    /**
     * @Route("/project/{projectId}/ticket/{id}", name="ticket_view", requirements={"id": "\d+", "projectId": "\d+"})
     */
    public function ViewAction($id)
    {
        $viewData = [
            'pageTitle' => 'Ticket #' . $id
        ];
        
        return $this->render('tickets/view.html.twig', $viewData);
    }
    
    /**
     * @Route("/project/{projectId}/ticket/create", name="ticket_create", requirements={
     *     "projectId": "\d+"
     * }))
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function CreateAction(Request $request)
    {
        $projectId = $request->query->get('projectId');
        exit($projectId);
        
        $ticket = new Issue();
        $form = $this->createFormBuilder($ticket)
                     ->add('title', TextType::class)
                     ->add('project_id', IntegerType::class)
                     ->add('submit', SubmitType::class)
                     ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid())
        {
            // insert data into database
            $project = $form->getData();
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($project);
            $doctrine->flush();
        
            // TODO - success flash message
            return $this->redirectToRoute('/project/' . $projectId);
        }
        
        $viewData = [
            'pageTitle' => 'Create Ticket',
            'form' => $form->createView()
        ];
        
        return $this->render('tickets/create.html.twig', $viewData);
    }

}
