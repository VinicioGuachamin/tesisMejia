<?php

namespace App\Form;

use App\Entity\EmpleadoA;
use App\Entity\Postbachillerato;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostbachilleratoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class)
            ->add('institucion', TextType::class)
            ->add('fecha_titulo', DateType::class, array( 'widget' => 'single_text'))
            ->add('empleado_a', EntityType::class, array(
                //'placeholder' => 'Seleccione...',
                'class' => EmpleadoA::class,
                'choice_label' => 'id'))
            ->add('guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Postbachillerato::class,
        ]);
    }
}
