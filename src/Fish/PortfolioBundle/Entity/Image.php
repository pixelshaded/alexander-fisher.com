<?php

namespace Fish\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fish\PortfolioBundle\Entity\Gallery;

/**
 * Fish\PortfolioBundle\Entity\Image
 *
 * @ORM\Table("images")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Image
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
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg"}
     * )
     *
     * @var File $image
     */
    protected $upload;
    
    protected $path;

    /**
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;
    
    /**
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;
    
    /**
     * @ORM\ManyToOne(targetEntity="Gallery")
     */
    private $gallery;


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
     * Set imageName
     *
     * @param string $imageName
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }
    
    public function setGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
        $gallery->addImage($this);
    }
    
    public function getGallery()
    {
        return $this->gallery;
    }
    
    public function getUpload()
    {
        return $this->upload;
    }
    
    public function setUpload($upload)
    {
        $this->upload = $upload;
    }
    
    public function getPath()
    {
        return $this->path;
    }
    
    public function setPath($path)
    {
        return $this->path = $path;
    }
    
    public function getAlt()
    {
        return $this->alt;
    }
    
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }
}
