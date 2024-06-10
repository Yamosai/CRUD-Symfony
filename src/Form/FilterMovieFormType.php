<?php

namespace App\Form;

use App\Repository\MovieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterMovieFormType extends AbstractType
{
    private $MovieRepository;

    public function __construct(MovieRepository $MovieRepository){

        $this->MovieRepository = $MovieRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du film : ',
                'required' => false,
            ])
            ->setMethod('GET')
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
