<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProjectsController extends Controller
{
    /**
     * @Route("/projects")
     */
    public function IndexAction()
    {
        return $this->render('AppBundle:Projects:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/project/create")
     */
    public function CreateAction()
    {
        return $this->render('AppBundle:Projects:create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/project/edit/{id}")
     */
    public function EditAction($id)
    {
        return $this->render('AppBundle:Projects:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/project/delete/{id}")
     */
    public function DeleteAction($id)
    {
        return $this->render('AppBundle:Projects:delete.html.twig', array(
            // ...
        ));
    }

}
