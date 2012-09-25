<?php

namespace Fish\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('tagline')
            ->add('intro')
            ->add('content')
            ->add('subcontent')
            ->add('category', 'entity', array(
                'class' => 'FishPortfolioBundle:Category',
                'property' => 'title'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fish\PortfolioBundle\Entity\Project'
        ));
    }

    public function getName()
    {
        return 'fish_portfoliobundle_projecttype';
    }
}
