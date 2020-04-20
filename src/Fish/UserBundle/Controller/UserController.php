<?php

namespace Fish\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\SecurityContext;
use Fish\UserBundle\Entity\User;
use Fish\UserBundle\Form\Type\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Fish\UserBundle\Entity\BlacklistIP;

class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Method({"get"})
     * @Template()
     */
    public function loginAction()
    {
        if (!$this->container->getParameter('login_enabled')){
            throw $this->createNotFoundException();
        }
        $request = $this->getRequest();
        $session = $request->getSession();
        
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } 
        else
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        $last_username = $session->get(SecurityContext::LAST_USERNAME);

        return array(
            'error'         => $error,
            'last_username' => $last_username,
        );
        
    }
    
    /**
     * @Route("/register", name="register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        if (!$this->container->getParameter('registration_enabled')){
            throw $this->createNotFoundException();
        }
        
        $user = new User();
        $form = $this->createForm(new RegisterType(), $user);
        
        if ($request->getMethod() === 'POST')
        {
            $form->bindRequest($request);
            
            if ($form->isValid())
            {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $em = $this->getDoctrine()->getManager();
                
                //get default user role
                $role = $em->getRepository('FishUserBundle:Role')->findOneBy(array('role' => 'ROLE_USER'));
                
                if (!$role)
                {
                    throw new \Exception('Could not get default role.');
                }
                
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);                
                $user->addRole($role);
                
                $em->persist($role);
                $em->persist($user);
                $em->flush();
                
                return $this->render('FishUserBundle:User:register_success.html.twig');
            }
            else
            {
                $error = 'Form was invalid.';
            }
        }

        return array(
            // last username entered by the user
            'error'         => null,
            'form'          => $form->createView()
        );
    }
    
    /**
     * @Route("/login_check", name="login_check")
     * @Method({"post"})
     */
    public function loginCheckAction(){}
    
    /**
     * @Route("/logout", name="logout")
     * @Method({"get"})
     */
    public function logoutAction(){}
    
}
