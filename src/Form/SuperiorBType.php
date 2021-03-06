<?php

namespace App\Form;

use App\Entity\EmpleadoB;
use App\Entity\SuperiorB;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuperiorBType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class)
            ->add('institucion', TextType::class)
            ->add('registro_senescyt', TextType::class)
            ->add('nivel', ChoiceType::class, array(
                'choices' => array(
                    'Tecnólogo' => 'Tecnólogo',
                    '3' => '3',
                    '4' => '4'),
                'expanded' => true,
                'multiple' => false))
            ->add('empleado_b', EntityType::class,array(
                //'placeholder' => 'Seleccione...',
                'class' => EmpleadoB::class,
                'choice_label' => 'id'))
            ->add('guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SuperiorB::class,
        ]);
    }
}
