<?php

namespace Axioma\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Axioma\MainBundle\Entity\Movies;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('quality', 'choice', array(
                'choices' => Movies::getQualityList()
            ))
            ->add('actor', 'entity', array(
                'class' => 'AxiomaMainBundle:Actors',
                'multiple' => true,
                'property' => 'name',
                'expanded' => true,
                'required' => false
            ))
            ->add('new_actor', 'collection', array(
                'label' => false,
                'type' => new ActorsType(),
                'allow_add' => true,
                'by_reference' => false
            ))
            ->add('tag', 'entity', array(
                'class' => 'AxiomaMainBundle:Tags',
                'multiple' => true,
                'property' => 'name',
                'expanded' => true,
                'required' => false
            ))
            ->add('new_tag', 'collection', array(
                'label' => false,
                'type' => new TagsType(),
                'allow_add' => true,
                'by_reference' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Axioma\MainBundle\Entity\Movies'
        ));
    }

    public function getName()
    {
        return 'axioma_mainbundle_moviestype';
    }
}
