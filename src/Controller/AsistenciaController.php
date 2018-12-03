<?php

namespace App\Controller;

use App\Entity\Asistencias;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AsistenciaController extends AbstractController
{
    /**
     * @Route("/asistencia", name="asistencia")
     */
    public function index()
    {
        $asistencia = $this->getDoctrine()->getRepository(Asistencias::class)->findAll();
        return $this->render('asistencia/index.html.twig', array('asistencia'=> $asistencia));
    }

    /**
     * VISTA PARA ELIMINAR UNA ASISTENCIA
     * @Route("/asistencia/{id}/vista/eliminar", name="vista_elminar_asistencia")
     */
    public function vistaEliminarAsistencia($id){

        return $this->render('asistencia/asistencia_eliminar.html.twig', array(
            'id'=>$id,
        ));

    }

    /**
     * FUNCIÓN PARA ELIMINAR UNA ASISTENCIA
     * @Route("/asistencia/{id}/eliminar", name="eliminar_asistencia")
     */
    public function eliminarEmpleadoA($id){
        $em = $this->getDoctrine()->getManager();
        $asistencia= $em->getRepository(Asistencias::class)->find($id);
        if (!$asistencia) {
            throw $this->createNotFoundException(
                'Elemento no encontrado con el id: '.$id
            );
        }
        $em->remove($asistencia);
        $em->flush();

        return $this->redirectToRoute('asistencia');
    }
}
