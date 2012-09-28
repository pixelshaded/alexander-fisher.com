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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

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
     * @Route("/{slug}/edit", name="admin_gallery_edit")
     * @Template()
     */
    public function editAction(Request $request, $slug)
    {
        $gallery = $this->getDoctrine()->getManager()->getRepository('FishPortfolioBundle:Gallery')->findOneBy(array('slug' => $slug));
        
        if (!$gallery)
        {
            throw $this->createNotFoundException('Could not find gallery.');
        }
        
        $form = $this->createForm(new GalleryType(), $gallery);
        
        if ($request->getMethod() === "POST")
        {            
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($gallery);
                $em->flush();
                
                return $this->redirect($this->generateUrl('admin_gallery_index', array('slug' => $gallery->getSlug())));
            }
        }
        
        return array(
            'form' => $form->createView(),
            'gallery' => $gallery
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
                $this->saveImageFile($image);
                $image->setGallery($gallery);
                
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
    
    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}/delete-image", name="admin_gallery_delete_image")
     * @Template()
     */
    public function deleteImageAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('FishPortfolioBundle:Image')->findOneBy(array('id' => $id));
        
        if (!$image)
        {
            throw $this->createNotFoundException('Could not find image.');
        }
        
        $form = $this->createFormBuilder()->getForm();
        
        if ($request->getMethod() === "DELETE")
        {            
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $this->removeImageFile($image);
                
                $image->getGallery()->removeImage($image);
                if ($image === $image->getGallery()->getCover()) $image->getGallery()->setCover(null);

                $em->remove($image);
                $em->persist($image->getGallery());
                $em->flush();
                
                return $this->redirect($this->generateUrl('admin_gallery_show', array('slug' => $image->getGallery()->getSlug())));
            }
        }
        
        return array(
            'form' => $form->createView(),
            'image' => $image
        );
    }
    
    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}/edit-image", name="admin_gallery_edit_image")
     * @Template()
     */
    public function editImageAction(Request $request, $id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('FishPortfolioBundle:Image')->findOneBy(array('id' => $id));
        
        $image = new Image();
        $form = $this->createForm(new ImageType(), $image);
        
        if (!$image)
        {
            throw $this->createNotFoundException('Could not find image.');
        }
        
        if ($request->getMethod() === "POST")
        {            
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $this->removeImageFile($image);
                $this->saveImageFile($image);
                
                $em->persist($image);
                $em->flush();
                
                return $this->redirect($this->generateUrl('admin_gallery_show', array('slug' => $image->getGallery()->getSlug())));
            }
        }
        
        return array(
            'form' => $form->createView(),
            'image' => $image
        );
    }
    
    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{slug}/edit-cover/{id}/", name="admin_gallery_edit_cover")
     * @Template()
     */
    public function editCoverAction(Request $request, $slug, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('FishPortfolioBundle:Gallery')->findOneBy(array('slug' => $slug));
        $image = $em->getRepository('FishPortfolioBundle:Image')->find($id);
        
        if (!$gallery || !$image)
        {
            throw $this->createNotFoundException('Could not find image or gallery');
        }
        
        $form = $this->createFormBuilder()->getForm();
        
        if ($request->getMethod() === 'POST')
        {
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $gallery->setCover($image);
                $em->persist($gallery);
                $em->flush();
                
                return $this->redirect($this->generateUrl('admin_gallery_show', array('slug' => $gallery->getSlug())));
            }
        }
        
        return array(
            'form' => $form->createView(),
            'gallery' => $gallery,
            'image' => $image
        );
    }    
    
    
    private function getUploadDirectory()
    {
        return $this->get('kernel')->getRootDir() . '/../web/' . $this->container->getParameter('img_upload_dir');
    }
    
    private function removeImageFile(Image $image)
    {
        $fs = new FileSystem();
                
        try 
        {                
            $fs->remove($this->getUploadDirectory() . '/' . $image->getFilename());
        }
        catch (IOException $e)
        {
            throw new \Error('There was an error deleting the image.');
        }
    }
    
    private function saveImageFile(Image &$image)
    {
        // use the original file name
        $file = $image->getUpload();
        $alt = pathinfo($file->getClientOriginalName());
        $alt = $alt['filename'];
        $alt = str_replace(array('.', ' '), '', $alt);
        $filename = uniqid() . '-' . $alt;

        // compute a random name and try to guess the extension (more secure)
        $extension = $file->guessExtension();
        if (!$extension) {
            throw new \Error('Extension could not be guessed.');
        }
        $filename.= '.' . $extension;

        try {
            $file->move($this->getUploadDirectory(), $filename);
        }
        catch (IOException $e)
        {
            throw new \Error('There was an error moving image to upload directory.');
        }

        $image->setFilename($filename);
        $image->setAlt($alt);
    }
}