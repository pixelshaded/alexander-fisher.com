<?php

namespace Fish\PortfolioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fish\PortfolioBundle\Entity\Category;

/**
 * Category controller.
 *
 * @Route("/categories")
 */
class CategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * Route("/", name="categories")
     * @Template()
     */
    public function categoryNavAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('FishPortfolioBundle:Category')->findAll();

        return array(
            'categories' => $categories,
        );
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{slug}/", name="category_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('FishPortfolioBundle:Category')->findOneBy(array('slug' => $slug));

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return array(
            'category'    => $category,
        );
    }

}
