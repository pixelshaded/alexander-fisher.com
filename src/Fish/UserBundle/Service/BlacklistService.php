<?php

namespace Fish\UserBundle\Service;

use Fish\UserBundle\Entity\BlacklistIP;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;

class BlacklistService implements AuthenticationFailureHandlerInterface, AuthenticationSuccessHandlerInterface
{
    protected $em;
    protected $failed_limit;
    protected $router;
    protected $container;
    
    public function __construct(&$container)
    {
        $this->em = $container->get('doctrine')->getManager();
        $this->failed_limit = $container->getParameter('failed_login_limit');
        $this->router = $container->get('router');
        $this->container = $container;
    }
    
    public function isBlocked($ip = null)
    {        
        if (!$ip) $ip = $this->container->get('request')->getClientIp();
        
        $blacklistip = $this->em->getRepository('FishUserBundle:BlacklistIP')->findOneBy(array('address' => $ip));
        
        if ($blacklistip && $blacklistip->getAttempts() > $this->failed_limit)
        {
            return true;
        }
        else return false;
    }
    
    private function addAttempt($ip)
    {
        $blacklistip = $this->em->getRepository('FishUserBundle:BlacklistIP')->findOneBy(array('address' => $ip));
        
        if(!$blacklistip) $blacklistip = new BlacklistIP();
        $blacklistip->setAddress($ip);
        $blacklistip->addAttempt();
        $this->em->persist($blacklistip);
        $this->em->flush();
    }
    
    private function clearAttempts($ip)
    {
        $blacklistip = $this->em->getRepository('FishUserBundle:BlacklistIP')->findOneBy(array('address' => $ip));
        if ($blacklistip)
        {
            $blacklistip->setAttempts(0);
            $this->em->persist($blacklistip);
            $this->em->flush();
        }
    }
    
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {        
        /* @var session Session */
        $session = $request->getSession();
        $ip = $request->getClientIp();
        
        if ($this->isBlocked($ip))
            $session->set(SecurityContext::AUTHENTICATION_ERROR, new AuthenticationException('Too many attempts'));
        else
        {
            $this->addAttempt($ip);
            $session->set(SecurityContext::AUTHENTICATION_ERROR, $exception);
        }
        
        return new RedirectResponse($this->router->generate('login'), 302);
    }
    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $this->clearAttempts($request->getClientIp());
        
        /* @var session Session */
        $session = $request->getSession();
        
        $url = $session->get('_security.target_path');
        
        if (!$url)
        {
            $url = $this->router->generate('project_index');
        }
        
        return new RedirectResponse($url, 302);
    }
}
