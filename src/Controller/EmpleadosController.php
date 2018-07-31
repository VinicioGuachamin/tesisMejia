<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmpleadosController extends Controller
{
    /**
     * @Route("/empleados", name="empleados")
     */
    public function index()
    {
        return $this->render('Empleados/empleados.html.twig');
    }
}
