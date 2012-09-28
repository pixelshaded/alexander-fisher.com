<?php

namespace Fish\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Fish\PortfolioBundle\Entity\Gallery;

/**
 * Fish\PortfolioBundle\Entity\Project
 *
 * Orm\MappedSuperclass
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project
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
     * @ORM\Column(name="title", type="string", length=60)
     */
    private $title;
    
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;
    
    /**
     * @var string $subtitle
     * 
     * @ORM\Column(name="subtitle", type="string", length=60)
     */
    private $subtitle;
    

    /**
     * @var string $tagline
     *
     * @ORM\Column(name="tagline", type="string", length=100)
     */
    private $tagline;
    

    /**
     * var string $intro
     * 
     * @ORM\Column(name="intro", type="text")
     */
    private $intro;
    
    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     * @var string $subcontent
     * 
     * @ORM\Column(name="subcontent", type="text")
     */
    private $subcontent;
    
    /**
     * @var Category $category
     * 
     * @ORM\ManyToOne(targetEntity="Category")
     */
    private $category;
    
    /**
     * @ORM\OneToOne(targetEntity="Gallery")
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
     * Set title
     *
     * @param string $title
     * @return Project
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
    
    public function getSubtitle()
    {
        return $this->subtitle;
    }
    
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }
    
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set tagline
     *
     * @param string $tagline
     * @return Project
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;
    
        return $this;
    }

    /**
     * Get tagline
     *
     * @return string 
     */
    public function getTagline()
    {
        return $this->tagline;
    }
    
    public function getIntro()
    {
        return $this->intro;
    }
    
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Project
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    
    public function getSubcontent()
    {
        return $this->subcontent;
    }
    
    public function setSubcontent($subcontent)
    {
        $this->subcontent = $subcontent;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory($category)
    {
        $this->category = $category;
        $category->addProject($this);
    }
    
    public function setGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }
    
    public function getGallery()
    {
        return $this->gallery;
    }
}
