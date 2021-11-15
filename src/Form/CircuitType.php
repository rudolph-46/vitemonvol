<?php

namespace App\Form;

use App\Entity\Circuit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class CircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('nbrDePlace')
            ->add('description')
            ->add('imageFile',  VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'delete_label' => '...',
                'download_label' => '...',
                'download_uri' => false,
                'image_uri' => false,
                'asset_helper' => false,
            ])
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Circuit::class,
        ]);
    }
}
