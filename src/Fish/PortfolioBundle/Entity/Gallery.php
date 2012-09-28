<?php

namespace Fish\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Fish\PortfolioBundle\Entity\Image;

/**
 * Fish\PortfolioBundle\Entity\Gallery
 *
 * @ORM\Table("galleries")
 * @ORM\Entity
 */
class Gallery
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=90)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;
    
    /**
     * @ORM\OneToOne(targetEntity="Image")
     */
    private $cover;
    
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="gallery")
     */
    private $images;

    
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    
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
     * Set title
     *
     * @param string $title
     * @return Gallery
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Gallery
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    public function getCover()
    {
        return $this->cover;
    }
    
    public function setCover(Image $cover)
    {
        $this->cover = $cover;
    }
    
    public function getImages()
    {
        return $this->images->toArray();
    }
    
    public function addImage(Image $image)
    {
        $this->images[] = $image;
    }
    
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }
}
