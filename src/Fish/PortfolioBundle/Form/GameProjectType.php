<?php

namespace Fish\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GameProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('tagline')
            ->add('platform')
            ->add('genre')
            ->add('languages')
            ->add('responsibilities')
            ->add('download')
            ->add('content')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fish\PortfolioBundle\Entity\GameProject'
        ));
    }

    public function getName()
    {
        return 'fish_portfoliobundle_gameprojecttype';
    }
}
