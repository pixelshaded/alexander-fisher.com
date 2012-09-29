<?php

namespace Fish\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FrontEndController extends Controller
{
    /**
     * @Route("/resume", name="fish_frontend_resume")
     * @Template()
     */
    public function resumeAction()
    {
        return array();
    }
    
    /**
     * @Route("/contact", name="fish_frontend_contact")
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }
    
    /**
     * @Route("/code-samples", name="fish_frontend_codesamples")
     * @Template()
     */
    public function codeSamplesAction()
    {
        return array();
    }
    
    /**
     * @Route("/demo-reel", name="fish_frontend_demoreel")
     * @Template()
     */
    public function demoReelAction()
    {
        return array();
    }
}
