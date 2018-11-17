<?php

namespace App\Form;

use App\Entity\Reporte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReporteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', DateType::class, array( 'widget' => 'single_text',
                'invalid_message' => 'Fecha Invalida'))
            ->add('jornada' ,  TextType::class)
            ->add('grado', TextType::class)
            ->add('paralelos', TextType::class)
            ->add('guardar', SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reporte::class,
        ]);
    }
}
