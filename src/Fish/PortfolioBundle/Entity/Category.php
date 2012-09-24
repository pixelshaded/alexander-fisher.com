<?php

namespace Fish\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Fish\PortfolioBundle\Entity\Project;

/**
 * Fish\PortfolioBundle\Entity\Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Category
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
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=60)
     */
    private $title;

    /**
     * @var string $subtitle
     *
     * @ORM\Column(name="subtitle", type="string", length=100)
     */
    private $subtitle;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @var ArrayCollection $projects
     * 
     * @ORM\OneToMany(targetEntity="Project", mappedBy="category")
     */
    private $projects;
    
    public function __construct()
    {
        $this->projects = new ArrayCollection();
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
     * @return Category
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
    
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Category
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    
        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getEntityClass()
    {
        return $this->entity_class;
    }
    
    public function setEntityClass($entity_class)
    {
        $this->entity_class = $entity_class;
    }
    
    public function getProjects()
    {
        return $this->projects->toArray();
    }
    
    public function addProject(Project $project)
    {
        $this->projects[] = $project;
        $project->setCategory($this);
    }
    
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);
        $project->setCategory(null);
    }
}
