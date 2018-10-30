<?php

namespace App\Controller;

use App\Entity\EmpleadoA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControlController extends Controller
{
    /**
     * @Route("/control", name="control")
     */
    public function index()
    {
        return $this->render('control/control.html.twig', [
            'controller_name' => 'ControlController',
        ]);
    }


    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     * @Route("/control/getEmpleados", name="getEmpleados")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function getEmpleados(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'select em.nombres, em.codbiometrico, hor.id, hor.lunes, hor.martes, hor.miercoles, hor.jueves, hor.viernes, hor.sabado 
                      from empleado_a em, horario hor where  em.horario_id= hor.id 
                      UNION 
                      select emb.nombres, emb.codbiometrico, horb.id, horb.lunes, horb.martes, horb.miercoles, horb.jueves, horb.viernes, horb.sabado
                      from empleado_b emb, horario horb where  emb.horario_id= horb.id ;';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $empleados = $statement->fetchAll();

        return new JsonResponse($empleados);
    }
}
