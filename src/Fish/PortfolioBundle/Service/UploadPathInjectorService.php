<?php

namespace Fish\PortfolioBundle\Service;

use Vich\UploaderBundle\Naming\NamerInterface;
use GRI\PointStoreBundle\Entity\PointProductImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Fish\PortfolioBundle\Entity\Image;

class UploadPathInjectorService
{    
    protected $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if ($entity instanceof Image)
        {
            $entity->setPath($this->path);
        }
    }
}