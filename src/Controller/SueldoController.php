<?php

namespace App\Controller;

use App\Entity\Sueldo;
use App\Form\SueldoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SueldoController extends Controller
{
    /**
     * @Route("/sueldo", name="sueldo")
     */
    public function index()
    {
        $sueldo = $this->getDoctrine()->getRepository(Sueldo::class)->findAll();

        return $this->render('sueldo/sueldo.html.twig', array
        ('sueldo'=> $sueldo));
    }


    /**
     * @Route("/sueldo/nuevo", name="sueldo_nuevo")
     */
    public function crearSueldo(Request $request){
        $sueldo = new Sueldo();
        $form = $this->createForm(SueldoType::class, $sueldo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sueldo = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($sueldo);
            $em->flush();

            return $this->redirectToRoute('sueldo');
        }

        return $this->render('sueldo/sueldoCrear.html.twig', array(
            'formSueldo' => $form->createView()
        ));

    }

    /**
     * @Route("/sueldo/{id}/editar", name="sueldo_editar")
     */
    public function editarSueldo(Request $request, $id){
        $sueldo = $this->getDoctrine()->getRepository(Sueldo::class)->find($id);
        $form = $this->createForm(SueldoType::class, $sueldo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('sueldo');
        }

        return $this->render('sueldo/sueldoEditar.html.twig', array(
            'formSueldo' => $form->createView(), 'id'=>$id
        ));

    }

    /**
     * @Route("/sueldo/{id}/eliminar", name="eliminarsueldo")
     */
    public function eliminarSueldo($id){
        $em = $this->getDoctrine()->getManager();
        $sueldo= $em->getRepository(Sueldo::class)->find($id);

        if (!$sueldo) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($sueldo);
        $em->flush();

        return $this->redirectToRoute('sueldo');

    }

    /**
     * @Route("/sueldo/{id}/vistaeliminar", name="vista_elminar_sueldo")
     */
    public function vistaEliminarSueldo($id){

        return $this->render('sueldo/sueldoEliminar.html.twig', array(
            'id'=>$id
        ));

    }


}
