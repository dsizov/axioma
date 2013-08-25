<?php

namespace Axioma\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('author', 'entity', array(
                'class' => 'AxiomaMainBundle:Authors',
                'multiple' => true,
                'property' => 'name',
                'expanded' => true,
                'required' => false
            ))
            ->add('new_author', 'collection', array(
                'label' => false,
                'type' => new AuthorsType(),
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
            ->add('translations', 'a2lix_translations')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Axioma\MainBundle\Entity\Books'
        ));
    }

    public function getName()
    {
        return 'axioma_mainbundle_bookstype';
    }
}
