<?php

namespace App\Controller;

use App\Entity\EmpleadoB;
use App\Form\EmpleadoBType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EmpleadoBController extends Controller
{
    /**
     * FUNCIÓN PARA CREAR UN NUEVO EMPLEADO B
     * @Route("/empleado/b/nuevo", name="empleadoB_nuevo")
     */
    public function crearEmpleadoB(Request $request){
        $empleado_b = new EmpleadoB();
        $form = $this->createForm(EmpleadoBType::class, $empleado_b);

        $form->handleRequest($request);
        $img = null;

        if ($form->isSubmitted() && $form->isValid()) {

            $empleado_b = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($empleado_b);
            $em->flush();

            return $this->redirectToRoute('empleados');
        }

        return $this->render('empleado_b/empleado_bCrear.html.twig', array(
            'formEmpleado_b' => $form->createView(), 'img'=>$img
        ));

    }

    /**
     * FUNCIÓN PARA EDITAR UN EMPLEADO B
     * @Route("/empleadoB/{id}/editar", name="empleadoB_editar")
     */
    public function editarEmpleadoB(Request $request, $id){
        $empleado_b = $this->getDoctrine()->getRepository(EmpleadoB::class)->find($id);
        $form = $this->createForm(EmpleadoBType::class, $empleado_b);

        $form->handleRequest($request);
        $img =$empleado_b->getFoto();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('empleados');
        }

        return $this->render('empleado_b/empleado_bCrear.html.twig', array(
            'formEmpleado_b' => $form->createView(),'img'=>$img
        ));

    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     * @Route("/get-neighborhoods-from-city", name="person_list_neighborhoods")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function listNeighborhoodsOfCityAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $neighborhoodsRepository = $em->getRepository("App\Entity\Parroquia");

        // Search the neighborhoods that belongs to the city with the given id as GET parameter "cityid"
        $neighborhoods = $neighborhoodsRepository->createQueryBuilder("q")
            ->where("q.canton = :cityid")
            ->setParameter("cityid", $request->query->get("cityid"))
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($neighborhoods as $neighborhood){
            $responseArray[] = array(
                "id" => $neighborhood->getId(),
                "nombre" => $neighborhood->getNombre()
            );
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }


    /**
     * FUNCIÓN PARA OBTENER EL VALOR DEL SUELDO SEGUN LA CATEGORÍA SELECCIONADA
     * @Route("/consulta_sueldo", name="consulta_sueldo")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function consultaSueldo(Request $request)
    {
        // Obtener la Entity and repository
        $em = $this->getDoctrine()->getManager();
        $sueldo = $em->getRepository("App\Entity\Sueldo");

        // Consulta para buscar el valor del sueldo según la categoría
        $valor= $sueldo->createQueryBuilder("q")
            ->where("q.id = :sueldoid")
            ->setParameter("sueldoid", $request->query->get("sueldoid"))
            ->getQuery()
            ->getResult();

        // Poner en un array los datos o atributos que necesitamos, en este caso el id y el valor
        $responseArray = array();
        foreach($valor as $val){
            $responseArray[] = array(
                "id" => $val->getId(),
                "valor" => $val->getValor()
            );
        }

        // Retorna en un array los valores necesitados
        return new JsonResponse($responseArray);

    }
}
