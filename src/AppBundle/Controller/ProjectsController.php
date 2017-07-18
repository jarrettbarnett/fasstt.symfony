<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Project;

class ProjectsController extends Controller
{
    /**
     * @Route("/project/{id}", name="project_index", requirements={
     *     "id": "\d+"
     * })
     */
    public function IndexAction($id)
    {
        // get project by id
        $project = $this->getDoctrine()->getRepository('AppBundle:Project')->find($id);

        // get issues for project
        $issues = $this->getDoctrine()->getRepository('AppBundle:Issue')->findBy([
            'projectId' => $project->getId()
        ]);

        // set viewdata
        $viewData = [
            'project' => $project,
            'projectId' => $project->getId(),
            'issues' => $issues,
            'pageTitle' => 'Project: ' . $project->getTitle()
        ];

        return $this->render('projects/index.html.twig', $viewData);
    }

    /**
     * @Route("/project/create", name="project_create")
     */
    public function CreateAction(Request $request)
    {
        // create new project
        $project = new Project();

        $form = $this->createFormBuilder($project)
            ->add('title', TextType::class)
            ->add('author_id', IntegerType::class)
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
            return $this->redirectToRoute('dashboard');
        }

        $viewData = [
            'pageTitle' => 'Create Project',
            'form' => $form->createView()
        ];

        return $this->render('projects/create.html.twig', $viewData);
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
        // fetch project record
        $doctrine = $this->getDoctrine()->getManager();
        $project = $doctrine->getRepository('AppBundle:Project')->find($id);

        // check if project retrieved
        if (!$project)
        {
            throw $this->createNotFoundException(
                'No project found for project id: ' . $id
            );
        }

        // delete project
        $doctrine->remove($project);
        $doctrine->flush();

        // return user to view
        // TODO - use flash messages instead
        return $this->render('projects/delete.html.twig', [
            'project' => $project,
            'status' => 'success'
        ]);
    }

}
