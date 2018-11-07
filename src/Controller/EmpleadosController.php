<?php

namespace App\Controller;

use App\Entity\Bachillerato;
use App\Entity\BachilleratoB;
use App\Entity\EmpleadoA;
use App\Entity\EmpleadoB;
use App\Entity\Postbachillerato;
use App\Entity\PostbachilleratoB;
use App\Entity\Superior;
use App\Entity\SuperiorB;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmpleadosController extends Controller
{
    /**
     * @Route("/empleados", name="empleados")
     */
    public function verEmpleados()
    {
        $empleados_a = $this->getDoctrine()->getRepository(EmpleadoA::class)->findAll();
        $empleados_b = $this->getDoctrine()->getRepository(EmpleadoB::class)->findAll();

        return $this->render('Empleados/empleados.html.twig', array
        ('empleados_a'=> $empleados_a, 'empleados_b'=> $empleados_b ));

    }


    /**
     * @Route("/empleado/a/{id}/ver", name="verEmpleadoA")
     */
    public function verEmpleadoA($id){
        $empleado_a = $this->getDoctrine()->getRepository(EmpleadoA::class)->find($id);

        $bachillerato = $this->getDoctrine()->getRepository(Bachillerato::class)->findBy(
            ['empleado_a' => $id]
        );

        $postbachillerato = $this->getDoctrine()->getRepository(Postbachillerato::class)->findBy(
            ['empleado_a' => $id]
        );

        $superior = $this->getDoctrine()->getRepository(Superior::class)->findBy(
            ['empleado_a' => $id]
        );

        return $this->render('Empleados/verEmpleadoA.html.twig', array(
            'empleado_a'=> $empleado_a,
            'bachillerato' => $bachillerato,
            'postbachillerato' => $postbachillerato,
            'superior' => $superior
        ));

    }

    /**
     * @Route("/empleado/b/{id}/ver", name="verEmpleadoB")
     */
    public function verEmpleadoB($id){
        $empleado_b = $this->getDoctrine()->getRepository(EmpleadoB::class)->find($id);

        $bachillerato_b = $this->getDoctrine()->getRepository(BachilleratoB::class)->findBy(
            ['empleado_b' => $id]
        );

        $postbachillerato_b = $this->getDoctrine()->getRepository(PostbachilleratoB::class)->findBy(
            ['empleado_b' => $id]
        );

        $superior_b = $this->getDoctrine()->getRepository(SuperiorB::class)->findBy(
            ['empleado_b' => $id]
        );

        return $this->render('Empleados/verEmpleadoB.html.twig', array(
            'empleado_b'=> $empleado_b,
            'bachillerato_b' => $bachillerato_b,
            'postbachillerato_b' => $postbachillerato_b,
            'superior_b' => $superior_b
        ));

    }
}

