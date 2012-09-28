<?php

namespace Fish\PortfolioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fish\PortfolioBundle\Entity\Gallery;
use Fish\PortfolioBundle\Form\GalleryType;
use Symfony\Component\HttpFoundation\Request;
use Fish\PortfolioBundle\Entity\Image;
use Fish\PortfolioBundle\Form\ImageType;

/**
 * Project controller.
 *
 * @Route("/admin/galleries")
 */
class AdminGalleryController extends Controller
{
    /**
     * Lists all Project entities.
     *
     * @Route("/", name="admin_gallery_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galleries = $em->getRepository('FishPortfolioBundle:Gallery')->findAll();

        return array(
            'galleries' => $galleries,
        );
    }
    
    /**
     * Finds and displays a Project entity.
     *
     * @Route("/new", name="admin_gallery_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $gallery = new Gallery();
        $form = $this->createForm(new GalleryType(), $gallery);
        
        if ($request->getMethod() === "POST")
        {            
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($gallery);
                $em->flush();
                
                return $this->redirect($this->generateUrl('admin_gallery_show', array('slug' => $gallery->getSlug())));
            }
        }
        
        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{slug}/", name="admin_gallery_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $gallery = $this->getDoctrine()->getManager()->getRepository('FishPortfolioBundle:Gallery')->findOneBy(array('slug' => $slug));
        
        if (!$gallery)
        {
            throw $this->createNotFoundException('Could not find gallery.');
        }
        
        return array(
            'gallery' => $gallery
        );
    }
    
    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{slug}/new-image", name="admin_gallery_new_image")
     * @Template()
     */
    public function newImageAction(Request $request, $slug)
    {
        $image = new Image();
        $form = $this->createForm(new ImageType(), $image);
        
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('FishPortfolioBundle:Gallery')->findOneBy(array('slug' => $slug));
        
        if (!$gallery)
        {
            throw $this->createNotFoundException('Could not find gallery.');
        }
        
        if ($request->getMethod() === "POST")
        {            
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                // use the original file name
                $file = $image->getUpload();
                $alt = str_replace(array('.', ' '), '', $file->getClientOriginalName());
                $filename = uniqid() . '-' . $alt;

                // compute a random name and try to guess the extension (more secure)
                $extension = $file->guessExtension();
                if (!$extension) {
                    // extension cannot be guessed
                    exit;
                }
                $filename.= '.' . $extension;
                
                $file->move($this->get('kernel')->getRootDir() . '/../web/img/uploads', $filename);
                
                $image->setFilename($filename);
                $image->setGallery($gallery);
                $image->setAlt($alt);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($image);
                $em->persist($gallery);
                $em->flush();
                
                return $this->redirect($this->generateUrl('admin_gallery_show', array('slug' => $image->getGallery()->getSlug())));
            }
        }
        
        return array(
            'form' => $form->createView(),
            'gallery' => $gallery
        );
    }
}
