<?php

namespace Fish\PortfolioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fish\PortfolioBundle\Entity\Project;
use Fish\PortfolioBundle\Form\ProjectType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Project controller.
 *
 * @Route("/admin/projects")
 */
class AdminProjectController extends Controller
{
    /**
     * Lists all Project entities.
     *
     * @Route("/", name="admin_project_index")
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
     * @Route("/new", name="admin_project_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm(new ProjectType(), $project);
        
        if ($request->getMethod() === "POST")
        {            
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();
                
                return $this->redirect($this->generateUrl('project_show', array('slug' => $project->getSlug())));
            }
        }
        
        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{slug}/new", name="admin_project_edit")
     * @Template()
     */
    public function editAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('FishPortfolioBundle:Project')->findOneBy(array('slug' => $slug));
        
        if (!$project)
        {
            throw \Error('Coud not find Project.');
        }
        
        $form = $this->createForm(new ProjectType(), $project);
        
        if ($request->getMethod() === "POST")
        {            
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();
                
                return $this->redirect($this->generateUrl('project_show', array('slug' => $project->getSlug())));
            }
        }
        
        return array(
            'project' => $project,
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/{slug}/delete", name="admin_project_delete")
     * @Template
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('FishPortfolioBundle:Project')->findOneBy(array('slug' => $slug));
        
        if (!$project) throw \Error('Could not find project.');
        
        $form = $this->createFormBuilder()->getForm();
        
        if ($request->getMethod() === "DELETE")
        {
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em->remove($project);
                $em->flush();
                return $this->redirect($this->generateURL('admin_project_index'));
            }
        }
        
        return array(
            'project' => $project,
            'form' => $form->createView()
        );
    }   

}
