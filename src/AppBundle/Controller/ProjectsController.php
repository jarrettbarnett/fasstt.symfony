<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProjectsController extends Controller
{
    /**
     * @Route("/project/{id}", name="project_index")
     */
    public function IndexAction()
    {
        return $this->render('projects/index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/project/create", name="project_create")
     */
    public function CreateAction()
    {
        return $this->render('projects/create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/project/edit/{id}", name="project_edit")
     */
    public function EditAction($id)
    {
        return $this->render('projects/edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/project/delete/{id}", name="project_delete")
     */
    public function DeleteAction($id)
    {
        return $this->render('projects/delete.html.twig', array(
            // ...
        ));
    }

}
