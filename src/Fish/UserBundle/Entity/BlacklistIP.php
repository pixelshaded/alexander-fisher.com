<?php

namespace Fish\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fish\UserBundle\Entity\BlacklistIP
 *
 * @ORM\Table("blacklisted_ips")
 * @ORM\Entity
 */
class BlacklistIP
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var integer $attempts
     *
     * @ORM\Column(name="attempts", type="integer")
     */
    private $attempts;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ip_address
     *
     * @param string $ipAddress
     * @return BlacklistIP
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->ip_address;
    }

    /**
     * Set failed_attempts
     *
     * @param integer $failedAttempts
     * @return BlacklistIP
     */
    public function setAttempts($Attempts)
    {
        $this->attempts = $Attempts;
    }
    
    public function addAttempt()
    {
        $this->attempts++;
    }

    /**
     * Get attempts
     *
     * @return integer 
     */
    public function getAttempts()
    {
        return $this->attempts;
    }
}
