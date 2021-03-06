<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Bachillerato;
use App\Entity\EmpleadoA;
use App\Entity\Postbachillerato;
use App\Entity\Superior;
use App\Form\BachilleratoType;
use App\Form\EmpleadoAType;
use App\Form\PostbachilleratoType;
use App\Form\SuperiorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class EmpleadoAController extends Controller
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
       $this->encoder = $encoder;
    }
    /**
     * @Route("/empleado/a", name="empleado_a")
     */
    public function index()
    {
        return $this->render('empleado_a/index.html.twig', [
            'controller_name' => 'EmpleadoAController',
        ]);
    }

    /**
     * FUNCIÓN PARA CREAR UN NUEVO EMPLEADO A
     * @Route("/empleado/a/nuevo", name="empleadoA_nuevo")
     */
    public function crearEmpleadoA(Request $request){
        $empleado_a = new EmpleadoA();
        $form = $this->createForm(EmpleadoAType::class, $empleado_a);

        $form->handleRequest($request);
        $img = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $empleado_a = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($empleado_a);
            $em->flush();
            $id= $empleado_a->getId();

            $nombre=  $empleado_a->getNombres(); 
            $apellido =  $empleado_a->getApellidos(); 
            $username = $nombre . " ". $apellido . " / C.I. ".$empleado_a->getCedula();

            /*Guardo credenciales de acceso del empleado en la table User */
            $manager = $this->getDoctrine()->getManager();
            $user = new User();
            $user->setUsername(
                $empleado_a->getCedula()
            );
            $user->setPassword(
                 $this->encoder->encodePassword($user, $empleado_a->getCedula())
            );
            $user->setEmail(
                 $username
            );
            $user->setRole(
                $empleado_a->getRol()
            );
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('empleadoA_educacion', array(
                'id'=>$id
            ));
        }
        

        return $this->render('empleado_a/empleado_aCrear.html.twig', array(
            'formEmpleado_a' => $form->createView(), 'img'=>$img
        ));

    }

    /**
     * FUNCIÓN PARA EDITAR UN EMPLEADO A
     * @Route("/empleado/a/{id}/editar", name="empleadoA_editar")
     */
    public function editarEmpleadoA(Request $request, $id){
        $empleado_a = $this->getDoctrine()->getRepository(EmpleadoA::class)->find($id);
        $form = $this->createForm(EmpleadoAType::class, $empleado_a);

        $form->handleRequest($request);
        $img =$empleado_a->getFoto();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('empleadoA_educacion', array(
                'id'=>$id
            ));
        }

        return $this->render('empleado_a/empleado_aCrear.html.twig', array(
            'formEmpleado_a' => $form->createView(),'img'=>$img
        ));

    }

    /**
     * FUNCIÓN PARA ELIMINAR UN EMPLEADO A
     * @Route("/empleado/a/{id}/eliminar", name="eliminar_empleadoA")
     */
    public function eliminarEmpleadoA($id){
        $em = $this->getDoctrine()->getManager();
        $bachillerato = $em->getRepository(Bachillerato::class)->findBy(
            ['empleado_a' => $id]
        );

        $postbachillerato = $this->getDoctrine()->getRepository(Postbachillerato::class)->findBy(
            ['empleado_a' => $id]
        );

        $superior = $this->getDoctrine()->getRepository(Superior::class)->findBy(
            ['empleado_a' => $id]
        );

        $empleado_a= $em->getRepository(EmpleadoA::class)->find($id);

        if (!$empleado_a) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        foreach ($bachillerato as $bach) {
            $em->remove($bach);
        }
        foreach ($postbachillerato as $postbach) {
            $em->remove($postbach);
        }
        foreach ($superior as $super) {
            $em->remove($super);
        }

        $em->remove($empleado_a);
        $em->flush();

        return $this->redirectToRoute('empleados');

    }

    /**
     * VISTA PARA ELIMINAR UN EMPLEADO A
     * @Route("/empleado/a/{id}/vista/eliminar", name="vista_elminar_empleadoA")
     */
    public function vistaEliminarEmpleadoA($id){

        return $this->render('empleado_a/empleado_Aeliminar.html.twig', array(
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

        // ej.
        // [{"id":"3","valor":"1234"},{"id":"4","valor":"9876"}]
    }


    /**
     * FUNCIÓN PARA CREAR UN NUEVO BACHILLERATO
     * @Route("/empleado/a/nuevo/bachillerato/{id}", name="empleadoA_nuevoBachillerato")
     */
    public function crearEmpleadoABachillerato(Request $request, $id){

        //Verifico si hay datos en la tabla Bachillerato con el id del Empleado
        $bachilleratoData = $this->getDoctrine()
            ->getRepository(Bachillerato::class)
            ->findOneBy(['empleado_a'=>$id]);

        //Inicializo una varibale en caso de que exista o no datos con el id del Empleado en la tabla Bachillerato
        if (empty($bachilleratoData) == 0){
            $data = true;
        }else{
            $data = false;
        }

        $bachillerato = new Bachillerato();
        $form = $this->createForm(BachilleratoType::class, $bachillerato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bachillerato = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($bachillerato);
            $em->flush();

            return $this->redirectToRoute('empleadoA_educacion', array('id'=>$id));
        }

        return $this->render('empleado_a/bachillerato.html.twig', array(
            'formEmpleado_a' => $form->createView(),
            'id'=>$id,
            'data'=>$data
        ));
    }


    /**
     * FUNCIÓN PARA EDITAR UN BACHILLERATO
     * @Route("/empleado/a/nuevo/bachillerato/{id}/editar/{idEmpleado}", name="empleadoA_editarBachillerato")
     */
    public function editarEmpleadoABachillerato(Request $request, $id, $idEmpleado){

        $bachillerato = $this->getDoctrine()->getRepository(Bachillerato::class)->find($id);
        $form = $this->createForm(BachilleratoType::class, $bachillerato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bachillerato = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($bachillerato);
            $em->flush();
            return $this->redirectToRoute('empleadoA_educacion', array('id'=>$idEmpleado));
        }

        return $this->render('empleado_a/bachillerato_editar.html.twig', array(
            'formEmpleado_a' => $form->createView(),
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));
    }

    /**
     * FUNCIÓN PARA ELIMINAR UN BACHILLERATO REGISTRADO
     * @Route("/empleado/a/nuevo/bachillerato/{id}/eliminar/{idEmpleado}", name="empleadoA_eliminarBachillerato")
     */
    public function eliminarEmpleadoABachillerato($id, $idEmpleado){
        $em = $this->getDoctrine()->getManager();
        $bachillerato= $em->getRepository(Bachillerato::class)->find($id);

        if (!$bachillerato) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($bachillerato);
        $em->flush();

        return $this->redirectToRoute('empleadoA_educacion', array('id'=>$idEmpleado));

    }

    /**
     * @Route("/empleado/a/nuevo/bachillerato/{id}/vistaeliminar/{idEmpleado}", name="vista_elminar_bachillerato")
     */
    public function vistaEliminarBchillerato($id, $idEmpleado){

        return $this->render('empleado_a/bachillerato_eliminar.html.twig', array(
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));

    }

    /**
     * FUNCIÓN PARA RENDERISAR LA VISTA DE LOS OFRMULARIOS EDUCACIÓN EMPLEADOA
     * @Route("/empleado/a/nuevo/educacion/{id}", name="empleadoA_educacion")
     */
    public function empleadoAEducacion($id){
        $bachillerato = $this->getDoctrine()->getRepository(Bachillerato::class)->findBy(
            ['empleado_a' => $id]
        );

        $postbachillerato = $this->getDoctrine()->getRepository(Postbachillerato::class)->findBy(
            ['empleado_a' => $id]
        );

        $superior = $this->getDoctrine()->getRepository(Superior::class)->findBy(
            ['empleado_a' => $id]
        );

        return $this->render('empleado_a/educacion.html.twig', array(
            'bachillerato' => $bachillerato,
            'postbachillerato' => $postbachillerato,
            'superior'=> $superior,
            'idEmpladoA' => $id
        ));

    }


    /**
     * FUNCIÓN PARA CREAR UN NUEVO POSTBACHILLERATO
     * @Route("/empleado/a/nuevo/postbachillerato/{id}", name="empleadoA_nuevoPostbachillerato")
     */
    public function crearEmpleadoAPostbachillerato(Request $request, $id){

        //Verifico si hay datos en la tabla PostBachillerato con el id del Empleado
        $postbachilleratoData = $this->getDoctrine()
            ->getRepository(Postbachillerato::class)
            ->findOneBy(['empleado_a'=>$id]);

        //Inicializo una varibale en caso de que exista o no datos con el id del Empleado en la tabla Bachillerato
        if (empty($postbachilleratoData) == 0){
            $data = true;
        }else{
            $data = false;
        }

        $postbachillerato = new Postbachillerato();
        $form = $this->createForm(PostbachilleratoType::class, $postbachillerato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postbachillerato = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($postbachillerato);
            $em->flush();

            return $this->redirectToRoute('empleadoA_educacion', array('id'=>$id));
        }

        return $this->render('empleado_a/postbachillerato_crear.html.twig', array(
            'formEmpleado_a' => $form->createView(),
            'id'=>$id,
            'data'=>$data
        ));
    }


    /**
     * FUNCIÓN PARA EDITAR UN POSTBACHILLERATO
     * @Route("/empleado/a/nuevo/postbachillerato/{id}/editar/{idEmpleado}", name="empleadoA_editarPostbachillerato")
     */
    public function editarEmpleadoAPostbachillerato(Request $request, $id, $idEmpleado){

        $postbachillerato = $this->getDoctrine()->getRepository(Postbachillerato::class)->find($id);
        $form = $this->createForm(PostbachilleratoType::class, $postbachillerato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postbachillerato = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($postbachillerato);
            $em->flush();
            return $this->redirectToRoute('empleadoA_educacion', array('id'=>$idEmpleado));
        }

        return $this->render('empleado_a/postbachillerato_editar.html.twig', array(
            'formEmpleado_a' => $form->createView(),
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));
    }


    /**
     * FUNCIÓN PARA ELIMINAR UN POSTBACHILLERATO REGISTRADO
     * @Route("/empleado/a/nuevo/postbachillerato/{id}/eliminar/{idEmpleado}", name="empleadoA_eliminarPostbachillerato")
     */
    public function eliminarEmpleadoAPostbachillerato($id, $idEmpleado){
        $em = $this->getDoctrine()->getManager();
        $postbachillerato= $em->getRepository(Postbachillerato::class)->find($id);

        if (!$postbachillerato) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($postbachillerato);
        $em->flush();

        return $this->redirectToRoute('empleadoA_educacion', array('id'=>$idEmpleado));

    }

    /**
     * @Route("/empleado/a/nuevo/postbachillerato/{id}/vistaeliminar/{idEmpleado}", name="vista_elminar_postbachillerato")
     */
    public function vistaEliminarPostbachillerato($id, $idEmpleado){

        return $this->render('empleado_a/postbachillerato_eliminar.html.twig', array(
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));

    }


    /**
     * FUNCIÓN PARA CREAR UN NUEVO SUPERIOR
     * @Route("/empleado/a/nuevo/superior/{id}", name="empleadoA_nuevoSuperior")
     */
    public function crearEmpleadoASuperior(Request $request, $id){
        $superior = new Superior();
        $form = $this->createForm(SuperiorType::class, $superior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $superior = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($superior);
            $em->flush();

            return $this->redirectToRoute('empleadoA_educacion', array('id'=>$id));
        }

        return $this->render('empleado_a/superior_crear.html.twig', array(
            'formEmpleado_a' => $form->createView(),
            'id'=>$id
        ));
    }

    /**
     * FUNCIÓN PARA EDITAR UN SUPERIOR
     * @Route("/empleado/a/nuevo/superior/{id}/editar/{idEmpleado}", name="empleadoA_editarSuperior")
     */
    public function editarEmpleadoASuperior(Request $request, $id, $idEmpleado){

        $superior = $this->getDoctrine()->getRepository(Superior::class)->find($id);
        $form = $this->createForm(SuperiorType::class, $superior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $superior = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($superior);
            $em->flush();
            return $this->redirectToRoute('empleadoA_educacion', array('id'=>$idEmpleado));
        }

        return $this->render('empleado_a/superior_editar.html.twig', array(
            'formEmpleado_a' => $form->createView(),
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));
    }


    /**
     * FUNCIÓN PARA ELIMINAR UN SUPERIOR REGISTRADO
     * @Route("/empleado/a/nuevo/superior/{id}/eliminar/{idEmpleado}", name="empleadoA_eliminarSuperior")
     */
    public function eliminarEmpleadoASuperior($id, $idEmpleado){
        $em = $this->getDoctrine()->getManager();
        $superior= $em->getRepository(Superior::class)->find($id);

        if (!$superior) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($superior);
        $em->flush();

        return $this->redirectToRoute('empleadoA_educacion', array('id'=>$idEmpleado));

    }

    /**
     * @Route("/empleado/a/nuevo/superior/{id}/vistaeliminar/{idEmpleado}", name="vista_elminar_superior")
     */
    public function vistaEliminarSuperior($id, $idEmpleado){

        return $this->render('empleado_a/superior_eliminar.html.twig', array(
            'id'=>$id,
            'idEmpleado'=>$idEmpleado
        ));

    }
}
