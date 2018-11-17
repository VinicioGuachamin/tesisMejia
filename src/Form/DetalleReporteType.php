<?php

namespace App\Form;

use App\Entity\DetalleReporte;
use App\Entity\Reporte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DetalleReporteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hr1')
            ->add('hr2')
            ->add('hr3')
            ->add('hr4')
            ->add('hr5')
            ->add('hr6')
            ->add('hr7')
            ->add('hr8')
            ->add('atrasos')
            ->add('abondonaAula')
            ->add('cumplimientoTurno')
            ->add('observaciones', TextareaType::class)
            ->add('guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetalleReporte::class,
        ]);
    }
}
