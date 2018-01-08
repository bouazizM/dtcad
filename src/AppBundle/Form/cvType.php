<?php

namespace AppBundle\Form;

use AppBundle\Entity\parcour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class cvType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastname')->add('firstname')->add('dateNaiss')->add('addr')->add('phone')->add('userId')
        ->add('parcours',parcourType::class,array('data_class'=>null));
            /*CollectionType::class, array(
            'entry_type' => parcourType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true));
            /*EntityType::class, array(
            // query choices from this entity
            'class' => 'AppBundle:parcour',
        'choice_label' => 'titre'));*/

        /*    CollectionType::class, array(
        'entry_type' => parcourType::class,
        'allow_add' => true,
        'allow_delete' => true,
        'prototype' => true));*/

            //
        //
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\cv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cv';
    }


}
