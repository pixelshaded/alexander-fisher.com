<?php

namespace Fish\PortfolioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fish\PortfolioBundle\Entity\Category;
use Fish\PortfolioBundle\Form\CategoryType;

/**
 * Category controller.
 *
 * @Route("/admin/portfolio/categories")
 */
class AdminCategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * @Route("/", name="admin_category_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('FishPortfolioBundle:Category')->findBy(array(), array('title' => 'asc'));

        return array(
            'categories' => $categories,
        );
    }
    
    /**
     * Lists all Category entities.
     *
     * @Route("/new", name="admin_category_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);
        
        if ($request->getMethod() === "POST")
        {
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em->persist($category);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_category_index'));
            }
        }
        
        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     *
     * @Route("/{slug}/edit", name="admin_category_edit")
     * @Template()
     */
    public function editAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('FishPortfolioBundle:Category')->findOneBy(array('slug' => $slug));
        
        $form = $this->createForm(new CategoryType(), $category);
        
        if ($request->getMethod() === "POST")
        {
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em->persist($category);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_category_index'));
            }
        }

        return array(
            'form' => $form->createView(),
            'category' => $category
        );
    }
    
    /**
     * @Route("/{slug}/delete", name="admin_category_delete")
     * @Template
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('FishPortfolioBundle:Category')->findOneBy(array('slug' => $slug));
        
        $form = $this->createFormBuilder()->getForm();
        
        if ($request->getMethod() === "DELETE")
        {
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em->remove($category);
                $em->flush();
                return $this->redirect($this->generateURL('admin_category_index'));
            }
        }
        
        return array(
            'category' => $category,
            'form' => $form->createView()
        );
    }   
}
