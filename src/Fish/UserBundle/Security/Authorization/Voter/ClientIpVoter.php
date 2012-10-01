<?php

namespace Fish\UserBundle\Security\Authorization\Voter;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ClientIpVoter implements VoterInterface
{
    public function __construct(ContainerInterface $container)
    {
        $this->container     = $container;
    }

    public function supportsAttribute($attribute)
    {
        // we won't check against a user attribute, so we return true
        return true;
    }

    public function supportsClass($class)
    {
        // our voter supports all type of token classes, so we return true
        return true;
    }

    function vote(TokenInterface $token, $object, array $attributes)
    {
        $request = $this->container->get('request');
        $ip = $request->getClientIp();
        
        $em = $this->container->get('doctrine')->getManager();
        $blacklistip = $em->getRepository('FishUserBundle:BlacklistIP')->findOneBy(array('address' => $ip));
        
        if ($blacklistip && $blacklistip->getAttempts() > $this->container->getParameter('failed_login_limit')) {
            return VoterInterface::ACCESS_DENIED;
        }

        return VoterInterface::ACCESS_ABSTAIN;
    }
}