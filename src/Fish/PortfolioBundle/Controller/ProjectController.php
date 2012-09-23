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
 * @Route("/")
 */
class ProjectController extends Controller
{
    /**
     * Lists all Project entities.
     *
     * @Route("", name="project_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('FishPortfolioBundle:Project')->findAll();

        return array(
            'projects' => $projects,
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/portfolio/{id}/", name="project_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FishPortfolioBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
