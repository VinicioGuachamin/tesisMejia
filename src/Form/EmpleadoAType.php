<?php

namespace App\Form;

use App\Entity\Canton;
use App\Entity\EmpleadoA;
use App\Entity\Horario;
use App\Entity\Sueldo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpleadoAType extends AbstractType
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foto',FileType::class, array('data_class' => null,
                'required' => false))
            ->add('rol', ChoiceType::class, array('placeholder' => 'Seleccione...',
                'choices' => array(
                    'Administrador' => 'ROLE_ADMIN',
                    'SuperUsuario' => 'ROLE_SUPERUSER',
                    'Usuario' => 'ROLE_USER',
                    'Ninguno' => 'NINGUNO')))
            ->add('tipoempleado', ChoiceType::class, array('placeholder' => 'Seleccione...',
                'choices' => array(
                    'Docente' => 'Docente',
                    'Médico' => 'Médico',
                    'Oficina' => 'Oficina')))
            ->add('nombres', TextType::class)
            ->add('apellidos', TextType::class)
            ->add('codbiometrico', IntegerType::class)
            ->add('cedula')
            ->add('fnacimiento',  DateType::class, array( 'widget' => 'single_text',
                'invalid_message' => 'Fecha Invalida'))
            ->add('ecivil', ChoiceType::class, array('placeholder' => 'Seleccione...',
                'choices' => array(
                    'Soltero/a' => 'Soltero/a',
                    'Unión de Hecho' => 'Unión de Hecho',
                    'Casado/a' => 'Casado/a',
                    'Divorciado/a' => 'Divorciado/a',
                    'Viudo/a' => 'Viudo/a')))
            ->add('tsangre', TextType::class)
            ->add('nombreconyugue', TextType::class, array('required' => false))
            ->add('cedulaconyugue', TextType::class, array('required' => false))
            ->add('cargafamiliar', IntegerType::class)
            ->add('hijos', IntegerType::class)
            ->add('cargaeduc', IntegerType::class)
            ->add('carnetconadis', TextType::class, array('required' => false))
            ->add('discapacidad', TextType::class, array('required' => false))
            ->add('cuentabanco', TextType::class)
            ->add('nombrebanco', TextType::class)
            ->add('tipocuenta', ChoiceType::class, array(
                'choices' => array(
                    'Ahorro' => 'Ahorro',
                    'Corriente' => 'Corriente'),
                'expanded' => true,
                'multiple' => false))
            ->add('ingresomagisterio', DateType::class, array( 'widget' => 'single_text',
                'invalid_message' => 'Fecha Invalida'))
            ->add('ingresoinstitucion', DateType::class, array( 'widget' => 'single_text',
                'invalid_message' => 'Fecha Invalida'))
            ->add('nombramiento', ChoiceType::class, array(
                'choices' => array(
                    'Definitivo' => 'Definitivo',
                    'Provisional' => 'Provisional',
                    'Reubicacion' => 'Reubicacion',
                    'Contrato' => 'Contrato'),
                'expanded' => true,
                'multiple' => true))
            ->add('jornada', ChoiceType::class, array(
                'choices' => array(
                    'Matutina' => 'Matutina',
                    'Vespertina' => 'Vespertina',
                    'Nocturna' => 'Nocturna'),
                'expanded' => true,
                'multiple' => true))
            ->add('niveljornada', ChoiceType::class, array(
                'choices' => array(
                    'EGB' => 'EGB',
                    'EGBS' => 'EGBS',
                    'BACH' => 'BACH',
                    'BI' => 'BI'),
                'expanded' => true,
                'multiple' => true))
            ->add('asignaturas', TextareaType::class)
            ->add('edificiolabora', ChoiceType::class, array(
                'choices' => array(
                    'Central' => 'Central',
                    'Sur' => 'Sur',
                    'Internado' => 'Internado'),
                'expanded' => true,
                'multiple' => true))
            ->add('directorarea', ChoiceType::class, array(
                'choices' => array(
                    'Si' => 'Si',
                    'No' => 'No'),
                'expanded' => true,
                'multiple' => false))
            ->add('descripdirarea', TextType::class)
            ->add('comision', ChoiceType::class, array(
                'choices' => array(
                    'Si' => 'Si',
                    'No' => 'No'),
                'expanded' => true,
                'multiple' => false))
            ->add('tipocomision', ChoiceType::class, array(
                'choices' => array(
                    'Coordinador' => 'Coordinador',
                    'Integrante' => 'Integrante'),
                'expanded' => true,
                'multiple' => false))
            ->add('nombrecomision', TextType::class)
            ->add('calleprincipal', TextType::class)
            ->add('calletransversal',TextType::class)
            ->add('numcasa', TextType::class)
            ->add('barrio', TextType::class)
            ->add('sector', TextType::class)
            ->add('teldomicilio', IntegerType::class)
            ->add('teloficina', IntegerType::class)
            ->add('celular', TextType::class)
            ->add('operadora', ChoiceType::class, array(
                'choices' => array(
                    'Movi' => 'Movi',
                    'Claro' => 'Claro',
                    'CNT' => 'CNT',
                    'Otro' => 'Otro'),
                'expanded' => true,
                'multiple' => false))
            ->add('emailprincipal', EmailType::class)
            ->add('emailalterno', EmailType::class)
            ->add('nombreemergencia', TextType::class)
            ->add('parentescoemergencia', TextType::class)
            ->add('telemergencia', IntegerType::class)
            ->add('sueldo', EntityType::class, array(
                'placeholder' => 'Seleccione...',
                'class' => Sueldo::class,
                'choice_label' => 'categoria'))

            ->add('horario', EntityType::class, array(
                'placeholder' => 'Seleccione...',
                'class' => Horario::class,
                'choice_label' => 'nombre'))
            ->add('valor', TextType::class, array('mapped'=>false))
            //->add('canton')
            //->add('parroquia')
            ->add('guardar', SubmitType::class)
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));

    }

    protected function addElements(FormInterface $form, Canton $city = null) {
        // 4. Add the province element
        $form->add('canton', EntityType::class, array(
            'required' => true,
            'data' => $city,
            'placeholder' => 'Seleccione...',
            'class' => 'App\Entity\Canton',
            'choice_label' => 'nombre'
        ));

        // Neighborhoods empty, unless there is a selected City (Edit View)
        $neighborhoods = array();

        // If there is a city stored in the Person entity, load the neighborhoods of it
        if ($city) {
            // Fetch Neighborhoods of the City if there's a selected city
            $repoNeighborhood = $this->em->getRepository('App\Entity\Parroquia');

            $neighborhoods = $repoNeighborhood->createQueryBuilder("q")
                ->where("q.canton = :cityid")
                ->setParameter("cityid", $city->getId())
                ->getQuery()
                ->getResult();
        }

        // Add the Neighborhoods field with the properly data
        $form->add('parroquia', EntityType::class, array(
            'required' => true,
            'placeholder' => 'Seleccione...',
            'class' => 'App\Entity\Parroquia',
            'choice_label' => 'nombre',
            'choices' => $neighborhoods
        ));
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Search for selected City and convert it into an Entity
        $city = $this->em->getRepository('App\Entity\Canton')->find($data['canton']);

        $this->addElements($form, $city);
    }

    function onPreSetData(FormEvent $event) {
        $person = $event->getData();
        $form = $event->getForm();

        // When you create a new person, the City is always empty
        $city = $person->getCanton() ? $person->getCanton() : null;

        $this->addElements($form, $city);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmpleadoA::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_person';
    }
}
