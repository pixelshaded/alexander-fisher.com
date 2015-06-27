<?php

namespace Fish\PortfolioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fish\PortfolioBundle\Entity\Project;
use Symfony\Component\HttpFoundation\Request;

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
    public function indexAction(Request $request)
    {
        if ($request->query->get('p') === "159")
        {
            return $this->render('FishFrontEndBundle:Wordpress:159.html.twig');
        }
        
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('FishPortfolioBundle:Project')->findAll();
        
        $projects_length = count($projects);
        
        if ($projects && count($projects) > 0)
        {
            $valid_showcases = array_filter($projects, function ($showcase)
            {
                return $showcase->getGallery() && $showcase->getGallery()->getImages() && count($showcase->getGallery()->getImages()) > 2;
            });
            $showcase = count($valid_showcases) > 0 ? $projects[array_rand($valid_showcases, 1)] : null;
        }
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
