<?php

namespace Fish\PortfolioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fish\PortfolioBundle\Entity\Project;

/**
 * Project controller.
 *
 * @Route("")
 */
class ProjectController extends Controller
{
    /**
     * Lists all Project entities.
     *
     * @Route("/", name="project_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('FishPortfolioBundle:Project')->findAll();
        
        if ($projects) $showcase = $projects[array_rand($projects, 1)];
        else $showcase = null;

        return array(
            'projects' => $projects,
            'showcase' => $showcase
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/portfolio/{slug}/", name="project_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('FishPortfolioBundle:Project')->findOneBy(array('slug' => $slug));

        if (!$project) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        return array(
            'project'      => $project,
        );
    }

}
