<?php

namespace Axioma\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('translations', 'a2lix_translations', array(
                'fields' => array(
                    'name' => array(
                        'label' => 'Name',
                        'locale_options' => array(
                            'ru' => array(
                                'label' => 'Название'
                            ),
                            'fr' => array(
                                'label' => 'Nom'
                            ),
                            'de' => array(
                                'label' => 'Name'
                            ),
                        )
                    )
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Axioma\MainBundle\Entity\Tags'
        ));
    }

    public function getName()
    {
        return 'axioma_mainbundle_tagstype';
    }
}
