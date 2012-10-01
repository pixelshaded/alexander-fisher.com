<?php

namespace Fish\UserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Fish\UserBundle\Entity\User;
use Fish\UserBundle\Service\BlacklistService;
use Doctrine\ORM\EntityManager;

class UserProvider implements UserProviderInterface
{
    protected $blacklist_service;
    protected $em;
    
    public function __construct(BlacklistService $blacklist_service, EntityManager $em)
    {
        $this->blacklist_service = $blacklist_service;
        $this->em = $em;
    }
    
    public function loadUserByUsername($username)
    {
        if ($this->blacklist_service->isBlocked())
        {
            throw new UsernameNotFoundException('Too many failed login attempts.');
        }
        
        $user = $this->em->getRepository('FishUserBundle:User')->findOneBy(array('username' => $username));
        
        if ($user)
        {
            return $user;
        }

        throw new UsernameNotFoundException('Bad credentials');
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Fish\UserBundle\Entity\User';
    }
}
