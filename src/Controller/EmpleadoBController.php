<?php

namespace App\Controller;

use App\Entity\BachilleratoB;
use App\Entity\EmpleadoB;
use App\Entity\PostbachilleratoB;
use App\Entity\SuperiorB;
use App\Form\BachilleratoBType;
use App\Form\EmpleadoBType;
use App\Form\PostbachilleratoBType;
use App\Form\SuperiorBType;
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
            $id= $empleado_b->getId();
            return $this->redirectToRoute('empleadoB_educacion', array(
                'id'=>$id
            ));
        }

        return $this->render('empleado_b/empleado_bCrear.html.twig', array(
            'formEmpleado_b' => $form->createView(), 'img'=>$img
        ));

    }

    /**
     * FUNCIÓN PARA EDITAR UN EMPLEADO B
     * @Route("/empleado/b/{id}/editar", name="empleadoB_editar")
     */
    public function editarEmpleadoB(Request $request, $id){
        $empleado_b = $this->getDoctrine()->getRepository(EmpleadoB::class)->find($id);
        $form = $this->createForm(EmpleadoBType::class, $empleado_b);

        $form->handleRequest($request);
        $img =$empleado_b->getFoto();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('empleadoB_educacion', array(
                'id'=>$id
            ));
        }

        return $this->render('empleado_b/empleado_bCrear.html.twig', array(
            'formEmpleado_b' => $form->createView(),'img'=>$img
        ));

    }

    /**
     * FUNCIÓN PARA ELIMINAR UN EMPLEADO B
     * @Route("/empleado/b/{id}/eliminar", name="eliminar_empleadoB")
     */
    public function eliminarEmpleadoB($id){
        $em = $this->getDoctrine()->getManager();
        $bachillerato_b = $em->getRepository(BachilleratoB::class)->findBy(
            ['empleado_a' => $id]
        );

        $postbachillerato_b = $this->getDoctrine()->getRepository(PostbachilleratoB::class)->findBy(
            ['empleado_a' => $id]
        );

        $superior_b = $this->getDoctrine()->getRepository(SuperiorB::class)->findBy(
            ['empleado_a' => $id]
        );

        $empleado_b= $em->getRepository(EmpleadoB::class)->find($id);

        if (!$empleado_b) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        foreach ($bachillerato_b as $bach) {
            $em->remove($bach);
        }
        foreach ($postbachillerato_b as $postbach) {
            $em->remove($postbach);
        }
        foreach ($superior_b as $super) {
            $em->remove($super);
        }

        $em->remove($empleado_b);
        $em->flush();

        return $this->redirectToRoute('empleados');

    }

    /**
     * VISTA PARA ELIMINAR UN EMPLEADO B
     * @Route("/empleado/b/{id}/vista/eliminar", name="vista_elminar_empleadoB")
     */
    public function vistaEliminarEmpleadoB($id){

        return $this->render('empleado_b/empleado_Beliminar.html.twig', array(
            'id'=>$id,
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

    /**
     * FUNCIÓN PARA CREAR UN NUEVO BACHILLERATO
     * @Route("/empleado/b/nuevo/bachillerato/{id}", name="empleadoB_nuevoBachillerato")
     */
    public function crearEmpleadoBBachillerato(Request $request, $id){

        //Verifico si hay datos en la tabla Bachillerato con el id del Empleado
        $bachilleratoData = $this->getDoctrine()
            ->getRepository(BachilleratoB::class)
            ->findOneBy(['empleado_b'=>$id]);

        //Inicializo una varibale en caso de que exista o no datos con el id del Empleado en la tabla Bachillerato
        if (empty($bachilleratoData) == 0){
            $data = true;
        }else{
            $data = false;
        }

        $bachillerato_b = new BachilleratoB();
        $form = $this->createForm(BachilleratoBType::class, $bachillerato_b);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bachillerato_b = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($bachillerato_b);
            $em->flush();

            return $this->redirectToRoute('empleadoB_educacion', array('id'=>$id));
        }

        return $this->render('empleado_b/bachilleratoB.html.twig', array(
            'formEmpleado_b' => $form->createView(),
            'id'=>$id,
            'data'=>$data
        ));
    }


    /**
     * FUNCIÓN PARA EDITAR UN BACHILLERATO
     * @Route("/empleado/b/nuevo/bachillerato/{id}/editar/{idEmpleado}", name="empleadoB_editarBachillerato")
     */
    public function editarEmpleadoBBachillerato(Request $request, $id, $idEmpleado){

        $bachillerato_b = $this->getDoctrine()->getRepository(BachilleratoB::class)->find($id);
        $form = $this->createForm(BachilleratoBType::class, $bachillerato_b);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bachillerato_b = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($bachillerato_b);
            $em->flush();
            return $this->redirectToRoute('empleadoB_educacion', array('id'=>$idEmpleado));
        }

        return $this->render('empleado_b/bachilleratoB_editar.html.twig', array(
            'formEmpleado_b' => $form->createView(),
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));
    }

    /**
     * FUNCIÓN PARA ELIMINAR UN BACHILLERATO REGISTRADO
     * @Route("/empleado/b/nuevo/bachillerato/{id}/eliminar/{idEmpleado}", name="empleadoB_eliminarBachillerato")
     */
    public function eliminarEmpleadoBBachillerato($id, $idEmpleado){
        $em = $this->getDoctrine()->getManager();
        $bachillerato_b= $em->getRepository(BachilleratoB::class)->find($id);

        if (!$bachillerato_b) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($bachillerato_b);
        $em->flush();

        return $this->redirectToRoute('empleadoB_educacion', array('id'=>$idEmpleado));

    }

    /**
     * @Route("/empleado/b/nuevo/bachillerato/{id}/vistaeliminar/{idEmpleado}", name="vista_elminar_bachilleratoB")
     */
    public function vistaEliminarBachilleratoB($id, $idEmpleado){

        return $this->render('empleado_b/bachilleratoB_eliminar.html.twig', array(
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));

    }

    /**
     * FUNCIÓN PARA RENDERISAR LA VISTA DE LOS OFRMULARIOS EDUCACIÓN EMPLEADOA
     * @Route("/empleado/b/nuevo/educacion/{id}", name="empleadoB_educacion")
     */
    public function empleadoBEducacion($id){
        $bachillerato_b = $this->getDoctrine()->getRepository(BachilleratoB::class)->findBy(
            ['empleado_b' => $id]
        );

        $postbachillerato_b = $this->getDoctrine()->getRepository(PostbachilleratoB::class)->findBy(
            ['empleado_b' => $id]
        );

        $superior_b = $this->getDoctrine()->getRepository(SuperiorB::class)->findBy(
            ['empleado_b' => $id]
        );

        return $this->render('empleado_b/educacionB.html.twig', array(
            'bachillerato_b' => $bachillerato_b,
            'postbachillerato_b' => $postbachillerato_b,
            'superior_b'=> $superior_b,
            'idEmpladoB' => $id
        ));

    }


    /**
     * FUNCIÓN PARA CREAR UN NUEVO POSTBACHILLERATO
     * @Route("/empleado/b/nuevo/postbachillerato/{id}", name="empleadoB_nuevoPostbachillerato")
     */
    public function crearEmpleadoBPostbachillerato(Request $request, $id){

        //Verifico si hay datos en la tabla PostBachillerato con el id del Empleado
        $postbachilleratoData = $this->getDoctrine()
            ->getRepository(PostbachilleratoB::class)
            ->findOneBy(['empleado_b'=>$id]);

        //Inicializo una varibale en caso de que exista o no datos con el id del Empleado en la tabla Bachillerato
        if (empty($postbachilleratoData) == 0){
            $data = true;
        }else{
            $data = false;
        }

        $postbachillerato_b = new PostbachilleratoB();
        $form = $this->createForm(PostbachilleratoBType::class, $postbachillerato_b);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postbachillerato_b = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($postbachillerato_b);
            $em->flush();

            return $this->redirectToRoute('empleadoB_educacion', array('id'=>$id));
        }

        return $this->render('empleado_b/postbachilleratoB_crear.html.twig', array(
            'formEmpleado_b' => $form->createView(),
            'id'=>$id,
            'data'=>$data
        ));
    }


    /**
     * FUNCIÓN PARA EDITAR UN POSTBACHILLERATO
     * @Route("/empleado/b/nuevo/postbachillerato/{id}/editar/{idEmpleado}", name="empleadoB_editarPostbachillerato")
     */
    public function editarEmpleadoBPostbachillerato(Request $request, $id, $idEmpleado){

        $postbachillerato_b = $this->getDoctrine()->getRepository(PostbachilleratoB::class)->find($id);
        $form = $this->createForm(PostbachilleratoBType::class, $postbachillerato_b);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postbachillerato_b = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($postbachillerato_b);
            $em->flush();
            return $this->redirectToRoute('empleadoB_educacion', array('id'=>$idEmpleado));
        }

        return $this->render('empleado_b/postbachilleratoB_editar.html.twig', array(
            'formEmpleado_b' => $form->createView(),
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));
    }


    /**
     * FUNCIÓN PARA ELIMINAR UN POSTBACHILLERATO REGISTRADO
     * @Route("/empleado/b/nuevo/postbachillerato/{id}/eliminar/{idEmpleado}", name="empleadoB_eliminarPostbachillerato")
     */
    public function eliminarEmpleadoBPostbachillerato($id, $idEmpleado){
        $em = $this->getDoctrine()->getManager();
        $postbachillerato_b= $em->getRepository(PostbachilleratoB::class)->find($id);

        if (!$postbachillerato_b) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($postbachillerato_b);
        $em->flush();

        return $this->redirectToRoute('empleadoB_educacion', array('id'=>$idEmpleado));

    }

    /**
     * @Route("/empleado/b/nuevo/postbachillerato/{id}/vistaeliminar/{idEmpleado}", name="vista_elminar_postbachilleratoB")
     */
    public function vistaEliminarPostbachilleratoB($id, $idEmpleado){

        return $this->render('empleado_b/postbachilleratoB_eliminar.html.twig', array(
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));

    }


    /**
     * FUNCIÓN PARA CREAR UN NUEVO SUPERIOR
     * @Route("/empleado/b/nuevo/superior/{id}", name="empleadoB_nuevoSuperior")
     */
    public function crearEmpleadoBSuperior(Request $request, $id){
        $superior_b = new SuperiorB();
        $form = $this->createForm(SuperiorBType::class, $superior_b);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $superior_b = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($superior_b);
            $em->flush();

            return $this->redirectToRoute('empleadoB_educacion', array('id'=>$id));
        }

        return $this->render('empleado_b/superiorB_crear.html.twig', array(
            'formEmpleado_b' => $form->createView(),
            'id'=>$id
        ));
    }

    /**
     * FUNCIÓN PARA EDITAR UN SUPERIOR
     * @Route("/empleado/b/nuevo/superior/{id}/editar/{idEmpleado}", name="empleadoB_editarSuperior")
     */
    public function editarEmpleadoBSuperior(Request $request, $id, $idEmpleado){

        $superior_b = $this->getDoctrine()->getRepository(SuperiorB::class)->find($id);
        $form = $this->createForm(SuperiorBType::class, $superior_b);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $superior_b = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($superior_b);
            $em->flush();
            return $this->redirectToRoute('empleadoB_educacion', array('id'=>$idEmpleado));
        }

        return $this->render('empleado_b/superiorB_editar.html.twig', array(
            'formEmpleado_b' => $form->createView(),
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));
    }


    /**
     * FUNCIÓN PARA ELIMINAR UN SUPERIOR REGISTRADO
     * @Route("/empleado/b/nuevo/superior/{id}/eliminar/{idEmpleado}", name="empleadoB_eliminarSuperior")
     */
    public function eliminarEmpleadoBSuperior($id, $idEmpleado){
        $em = $this->getDoctrine()->getManager();
        $superior_b= $em->getRepository(SuperiorB::class)->find($id);

        if (!$superior_b) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($superior_b);
        $em->flush();

        return $this->redirectToRoute('empleadoB_educacion', array('id'=>$idEmpleado));

    }

    /**
     * @Route("/empleado/b/nuevo/superior/{id}/vistaeliminar/{idEmpleado}", name="vista_elminar_superiorB")
     */
    public function vistaEliminarSuperiorB($id, $idEmpleado){

        return $this->render('empleado_b/superiorB_eliminar.html.twig', array(
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));

    }
}
