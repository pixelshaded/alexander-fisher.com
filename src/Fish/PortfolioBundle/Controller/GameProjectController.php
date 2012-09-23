<?php

namespace Fish\PortfolioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fish\PortfolioBundle\Entity\GameProject;
use Fish\PortfolioBundle\Form\GameProjectType;

/**
 * GameProject controller.
 *
 * @Route("/gameproject")
 */
class GameProjectController extends Controller
{
    /**
     * Lists all GameProject entities.
     *
     * @Route("/", name="gameproject")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FishPortfolioBundle:GameProject')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a GameProject entity.
     *
     * @Route("/{id}/show", name="gameproject_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FishPortfolioBundle:GameProject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GameProject entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new GameProject entity.
     *
     * @Route("/new", name="gameproject_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GameProject();
        $form   = $this->createForm(new GameProjectType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new GameProject entity.
     *
     * @Route("/create", name="gameproject_create")
     * @Method("POST")
     * @Template("FishPortfolioBundle:GameProject:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new GameProject();
        $form = $this->createForm(new GameProjectType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gameproject_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GameProject entity.
     *
     * @Route("/{id}/edit", name="gameproject_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FishPortfolioBundle:GameProject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GameProject entity.');
        }

        $editForm = $this->createForm(new GameProjectType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing GameProject entity.
     *
     * @Route("/{id}/update", name="gameproject_update")
     * @Method("POST")
     * @Template("FishPortfolioBundle:GameProject:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FishPortfolioBundle:GameProject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GameProject entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GameProjectType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gameproject_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a GameProject entity.
     *
     * @Route("/{id}/delete", name="gameproject_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FishPortfolioBundle:GameProject')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GameProject entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gameproject'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
