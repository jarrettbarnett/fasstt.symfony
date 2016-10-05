<?php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Sidebar implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        // setup menu
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-sidebar');

        // access services from the container!
        $doctrine = $this->container->get('doctrine')->getManager();

        // get projects
        $projects = $doctrine->getRepository('AppBundle:Project')->findAll();

        // create menu
        foreach ($projects as $project)
        {
            $menu->addChild($project->getTitle(), [
                'route' => 'project_index',
                'routeParameters' => [
                    'id' => $project->getId()
                ]
            ]);
        }

        return $menu;
    }
}