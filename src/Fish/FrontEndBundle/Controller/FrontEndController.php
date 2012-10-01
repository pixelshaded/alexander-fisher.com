<?php

namespace Fish\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontEndController extends Controller
{
    /**
     * @Route("/resume", name="fish_frontend_resume")
     * @Template()
     */
    public function resumeShowAction()
    {
        return array();
    }
    
    /**
     * @Route("/resume-print", name="fish_frontend_resume_print")
     * @Template()
     */
    public function resumePrintAction()
    {
        return array();
    }
    
    /**
     * @Route("/contact", name="fish_frontend_contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('email', 'email', array('label' => 'Your Email'))
                ->add('subject')
                ->add('message', 'textarea')
                ->add('antibot', 'choice', array(
                    'label' => 'Antibot',
                    'choices' => array(
                        '' => '',
                        'red' => 'The sky is red', 
                        'purple' => 'The sky is purple',
                        'blue' => 'The sky is blue',
                        'yellow' => 'The skiy is yellow'
                    )
                    
                ))
                ->getForm();
        
        $errors = null;
        
        if ($request->getMethod() === "POST")
        {
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $data = $form->getData();
                
                if ($data['antibot'] !== 'blue')
                {
                    $errors = "The sky is not " . $data['antibot'] . ". Are you sure you aren't a robot?";
                }
                else
                {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($data['subject'])
                        ->setFrom($data['email'])
                        ->setTo('mail@alexander-fisher.com')
                        ->setBody($data['message'])
                    ;
                    $this->get('mailer')->send($message);
                    
                    return $this->render('FishFrontEndBundle:FrontEnd:contact-success.html.twig');
                }
            }
        }
        
        return array(
            'form' => $form->createView(),
            'errors' => $errors
        );
    }
    
    /**
     * @Route("/code-samples", name="fish_frontend_codesamples")
     * @Template()
     */
    public function codeSamplesAction()
    {
        return $this->redirect('https://github.com/pixelshaded');
    }
    
    /**
     * @Route("/demo-reel", name="fish_frontend_demoreel")
     * @Template()
     */
    public function demoReelAction()
    {
        return array();
    }
    
    /**
     * @Route("/google4bfeecd7b5fca38a.html", name="fish_frontend_verifyGoogleApps")
     * @Template()
     */
    public function verifyGoogleAppsAction()
    {
        return new Response('google-site-verification: google4bfeecd7b5fca38a.html');
    }
}
