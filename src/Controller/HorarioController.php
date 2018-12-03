<?php

namespace App\Controller;

use App\Entity\Horario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HorarioController extends Controller
{
    /**
     * @Route("/horario", name="horario")
     */
    public function index()
    {
        $horarios = $this->getDoctrine()->getRepository(Horario::class)->findAll();
        return $this->render('horario/horario.html.twig',  array('horarios'=> $horarios));
    }

    /**
     * @Route("/horario/nuevo", name="horario_nuevo")
     */
    public function crearHorario(){

        return $this->render('horario/horarioCrear.html.twig');

    }

    /**
     * @Route("/horario/{id}/editarvista", name="horario_vista_editar")
     */
    public function VistaHorarioEditar($id){

        return $this->render('horario/horarioEditar.html.twig', array('id'=> $id));

    }

    /**
     * @Route("/horario/editar", name="horario_editar")
     * @Method("POST")
     */
    public function HorarioEditar(Request $request){
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "select * from horario where id='+$id+';";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $horario = $statement->fetchAll();
        return new JsonResponse($horario);
    }

    /**
     * @Route("/horario/nuevo/ajax", name="crearHorarioAjax")
     * @Method("POST")
     */
    public function AjaxCrearHorario(Request $request){
        $lunes = $request->request->get('lunes');
        $martes = $request->request->get('martes');
        $miercoles = $request->request->get('miercoles');
        $jueves = $request->request->get('jueves');
        $viernes = $request->request->get('viernes');
        $sabado = $request->request->get('sabado');
        $domingo = $request->request->get('domingo');
        $nombre = $request->request->get('nombre');

        $tableHorario = new Horario();
        $tableHorario->setLunes($lunes);
        $tableHorario->setMartes($martes);
        $tableHorario->setMiercoles($miercoles);
        $tableHorario->setJueves($jueves);
        $tableHorario->setViernes($viernes);
        $tableHorario->setSabado($sabado);
        $tableHorario->setDomingo($domingo);
        $tableHorario->setNombre($nombre);

        $em = $this->getDoctrine()->getManager();
        $em->persist($tableHorario);
        $em->flush();

        return new JsonResponse($lunes);
    }

    /**
     * @Route("/horario/editar/ajax", name="updateHorarioAjax")
     * @Method("POST")
     */
    public function AjaxUpdateHorario(Request $request){
        $id = $request->request->get('id');
        $lunes = $request->request->get('lunes');
        $martes = $request->request->get('martes');
        $miercoles = $request->request->get('miercoles');
        $jueves = $request->request->get('jueves');
        $viernes = $request->request->get('viernes');
        $sabado = $request->request->get('sabado');
        $domingo = $request->request->get('domingo');
        $nombre = $request->request->get('nombre');

        $tableHorario = new Horario();
        $tableHorario->setLunes($lunes);
        $tableHorario->setMartes($martes);
        $tableHorario->setMiercoles($miercoles);
        $tableHorario->setJueves($jueves);
        $tableHorario->setViernes($viernes);
        $tableHorario->setSabado($sabado);
        $tableHorario->setDomingo($domingo);
        $tableHorario->setNombre($nombre);

        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "update horario set lunes='".$lunes."', martes='".$martes."',miercoles='".$miercoles."',
                    jueves='".$jueves."', viernes='".$viernes."', sabado='".$sabado."', domingo='".$domingo."', 
                    nombre='".$nombre."' where id='+$id+';";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        //$horario = $statement->fetchAll();

        return new JsonResponse('{ "data": "ok" }');
    }
}
