<?php

namespace Fish\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('cover', 'entity', array(
                'class' => 'FishPortfolioBundle:Image',
                'property' => 'imageName',
                'empty_value' => '-- NONE --',
                'required' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fish\PortfolioBundle\Entity\Gallery'
        ));
    }

    public function getName()
    {
        return 'fish_portfoliobundle_gallerytype';
    }
}
