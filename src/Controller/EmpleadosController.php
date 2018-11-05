<?php

namespace App\Controller;

use App\Entity\EmpleadoA;
use App\Entity\EmpleadoB;
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

        return $this->render('Empleados/verEmpleadoA.html.twig', array
        ('empleado_a'=> $empleado_a));

    }

    /**
     * @Route("/empleado/b/{id}/ver", name="verEmpleadoB")
     */
    public function verEmpleadoB($id){
        $empleado_b = $this->getDoctrine()->getRepository(EmpleadoB::class)->find($id);

        return $this->render('Empleados/verEmpleadoB.html.twig', array
        ('empleado_b'=> $empleado_b));

    }
}
