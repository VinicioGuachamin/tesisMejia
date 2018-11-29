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
        return $this->render('horario/horario.html.twig');
    }

    /**
     * @Route("/horario/nuevo", name="horario_nuevo")
     */
    public function crearHorario(){
        /*$sueldo = new Sueldo();
        $form = $this->createForm(SueldoType::class, $sueldo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sueldo = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($sueldo);
            $em->flush();

            return $this->redirectToRoute('sueldo');
        }*/

        return $this->render('horario/horarioCrear.html.twig');

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

        $tableHorario = new Horario();
        $tableHorario->setLunes($lunes);
        $tableHorario->setMartes($martes);
        $tableHorario->setMiercoles($miercoles);
        $tableHorario->setJueves($jueves);
        $tableHorario->setViernes($viernes);
        $tableHorario->setSabado($sabado);
        $tableHorario->setDomingo($domingo);

        $em = $this->getDoctrine()->getManager();
        $em->persist($tableHorario);
        $em->flush();

        return new JsonResponse($lunes);
    }
}
