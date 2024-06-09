<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom du film :",
                'required' => false,
                'attr' => [
                'placeholder' => "Saissisez le nom du film",
                ],
            ])
            ->add('date', DateTimeType::class, [
                'label' => "Date de sortie du film :",
                'required' => false,
                'attr' => [
                'placeholder' => "Saissisez la date de sortie du film",
                ],
            ])
            ->add('synospis', TextType::class, [
                'label' => "Synospis film :",
                'required' => false,
                'attr' => [
                'placeholder' => "Saissisez le synospis du film",
                ],
            ])
            // submit      
            ->add('submit', SubmitType::class, [
                'label' => "Enregistrer",
            ]
        );
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
