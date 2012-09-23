<?php

namespace Fish\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fish\PortfolioBundle\Entity\Project;

/**
 * Fish\PortfolioBundle\Entity\GameProject
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GameProject extends Project
{
    /**
     * @var string $platform
     *
     * @ORM\Column(name="platform", type="string", length=255)
     */
    private $platform;

    /**
     * @var string $genre
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string $languages
     *
     * @ORM\Column(name="languages", type="string", length=255)
     */
    private $languages;

    /**
     * @var string $responsibilities
     *
     * @ORM\Column(name="responsibilities", type="string", length=255)
     */
    private $responsibilities;

    /**
     * @var string $download
     *
     * @ORM\Column(name="download", type="string", length=255)
     */
    private $download;

    /**
     * Set platform
     *
     * @param string $platform
     * @return GameProject
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    
        return $this;
    }

    /**
     * Get platform
     *
     * @return string 
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return GameProject
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    
        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set languages
     *
     * @param string $languages
     * @return GameProject
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    
        return $this;
    }

    /**
     * Get languages
     *
     * @return string 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set responsibilities
     *
     * @param string $responsibilities
     * @return GameProject
     */
    public function setResponsibilities($responsibilities)
    {
        $this->responsibilities = $responsibilities;
    
        return $this;
    }

    /**
     * Get responsibilities
     *
     * @return string 
     */
    public function getResponsibilities()
    {
        return $this->responsibilities;
    }

    /**
     * Set download
     *
     * @param string $download
     * @return GameProject
     */
    public function setDownload($download)
    {
        $this->download = $download;
    
        return $this;
    }

    /**
     * Get download
     *
     * @return string 
     */
    public function getDownload()
    {
        return $this->download;
    }
}
