<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\EmpleadoA;
use App\Entity\Reporte;
use App\Entity\DetalleReporte;
use App\Form\ReporteType;
use App\Form\DetalleReporteType;
use App\Repository\ReporteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use Symfony\Component\HttpFoundation\JsonResponse;



class InspeccionController extends AbstractController
{
	
    /**
     * @Route("/inspeccion", name="inspeccion")
     */
    public function index(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $filtro = $user->getEmail();
        $username = explode(" / ", $filtro);

        $docentes= $this->getDocentes();
        $form= $this->getFormReporteAction($request);
        $form2= $this->getFormDetalleReporteAction();
        return $this->render('inspeccion/index.html.twig', [
            'controller_name' => 'InspeccionController',
            'docentes' => $docentes,
            'form'=>$form->createView(),
            'form2'=>$form2->createView(),
            'username'=>$username[0]
        ]);
    }


    public function getDocentes(){

        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();

        //Consulta uso de SQL
        $RAW_QUERY = 'SELECT CONCAT(apellidos, " " , nombres) as username FROM empleado_a where empleado_a.tipoempleado = "Docente" ORDER BY apellidos;';
        
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();

        $docentes = array();

        foreach($result as $array)
        {      
            foreach($array as $docente)
            {
                $docentes[] = $docente; 
            }
        }
        return ($docentes);
    }


    public function getFormReporteAction(Request $request){ 
        $reporte = new Reporte();
        $form = $this->createForm(ReporteType::class, $reporte);
        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {

     
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $reporte->setInspector($user->getEmail());        
       
            //save !
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reporte);
            $entityManager->flush();
            $id= $reporte->getId();
   


            dump("Save Reporte Exit " . $id );
            die();

             return $this->redirectToRoute('inspeccion', array(
                'reporte'=>$reporte
            ));

            
        }
        
        return $form;

    }


    
    public function getFormDetalleReporteAction(){ 

        $detalleReporte = new DetalleReporte();
        $form = $this->createForm(DetalleReporteType::class, $detalleReporte);
        return $form;

    }


        /**
     * @Route("/inspeccion/ajax", name="reporte_ajax")
     */
    public function saveReporte(Request $request){ 

        $data = $request->request->get('detalleReporte');

        $detalleReporte = new DetalleReporte();
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $filtro = $user->getEmail();

         //Consulta uso de SQL

        $RAW_QUERY = "select MAX(id) AS id , fecha,inspector,jornada,grado,paralelos FROM reporte WHERE inspector = '".$filtro."'";
        
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();

        $reporte = $this->getDoctrine()->getRepository(Reporte::class)->findBy(
        ['id' => $result[0]['id']]);

        $detalleReporte->setReporte($reporte[0]);
        $detalleReporte->setDocente($data['docente']);
        $detalleReporte->setHr1($data['hr1']);
        $detalleReporte->setHr2($data['hr2']);
        $detalleReporte->setHr3($data['hr3']);
        $detalleReporte->setHr4($data['hr4']);
        $detalleReporte->setHr5($data['hr5']);
        $detalleReporte->setHr6($data['hr6']);
        $detalleReporte->setHr7($data['hr7']);
        $detalleReporte->setHr8($data['hr8']);
        $detalleReporte->setAtrasos($data['atrasos']);
        $detalleReporte->setAbondonaAula($data['abondonaAula']);
        $detalleReporte->setCumplimientoTurno($data['cumplimientoTurno']);
        $detalleReporte->setObservaciones($data['observaciones']);



        //save !
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($detalleReporte);
        $entityManager->flush();
        $id= $detalleReporte->getId();

       //$obj = new JsonResponse($arrData);


        return new JsonResponse($reporte[0]->getId());
    }




    /**
     * @Route("/inspeccion/ajax2", name="reporte_ajax_2")
     */
    public function saveReporte2(Request $request){ 

        $reporte = new Reporte();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $username= $user->getEmail();    

        $jornada = $request->request->get('jornada');
        $grado = $request->request->get('grado');
        $paralelos = $request->request->get('paralelos');
        $fecha = $request->request->get('fecha');

      
        $date = new \DateTime($fecha);


       
        $reporte->setFecha($date);
        $reporte->setInspector($username);
        $reporte->setJornada($jornada);
        $reporte->setGrado($grado);
        $reporte->setParalelos($paralelos);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reporte);
        $entityManager->flush();


        return new JsonResponse($reporte->getId());
    }



    /**
     * @Route("/inspeccion/ajax3", name="reporte_list_ajax")
     */
    public function findAllReporte(Request $request){ 

        $data = $request->request->get('idReporte');

        $em = $this->getDoctrine()->getManager();

        $reporte = $this->getDoctrine()->getRepository(Reporte::class)->find($data);


        $filtro = $reporte->getFecha()->format('Y-m-d H:i:s');



         //Consulta uso de SQL

        $RAW_QUERY = "select detalle_reporte.docente,detalle_reporte.observaciones, detalle_reporte.atrasos, detalle_reporte.atrasos, detalle_reporte.abondona_aula, detalle_reporte.cumplimiento_turno, detalle_reporte.reporte_id , reporte.fecha,reporte.inspector FROM detalle_reporte, reporte WHERE detalle_reporte.reporte_id = reporte.id and reporte.fecha = '".$filtro."' and reporte.id= '".$data."'";

        //and reporte.id = 8

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();



        return new JsonResponse($result);
    }



    /**
     * @Route("/inspeccion/ajax4", name="reporte_list_ajax4")
     */
    public function findAllReporte4(Request $request){ 

        $fecha = $request->request->get('fecha');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $filtro= $user->getEmail();

        $em = $this->getDoctrine()->getManager();

        //Consulta uso de SQL
        $RAW_QUERY = "select * FROM reporte WHERE inspector = '".$filtro."' and fecha = '".$fecha."' " ;
        //$RAW_QUERY = "select * from reporte where fecha = (select max( '".$fecha."') from reporte) and id = (select max(id) from reporte) and inspector=  '".$filtro."' "   ;
        


        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result1 = $statement->fetchAll();

        if(empty($result1)){
            return new JsonResponse($result1);

        }else{

            $idReporte = $result1[0]['id']; 

            //Consulta uso de SQL
            $RAW_QUERY = "select detalle_reporte.docente,detalle_reporte.observaciones, detalle_reporte.atrasos, detalle_reporte.atrasos, detalle_reporte.abondona_aula, detalle_reporte.cumplimiento_turno, detalle_reporte.reporte_id , reporte.fecha,reporte.inspector,reporte.jornada ,reporte.grado ,reporte.paralelos FROM detalle_reporte, reporte WHERE detalle_reporte.reporte_id = reporte.id and reporte.fecha = '".$fecha."' and reporte.id= '".$idReporte."' and reporte.inspector= '".$filtro."'   "  ;


            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();
            $result = $statement->fetchAll();

            if(empty($result)){
               return new JsonResponse($result1);
            }

            return new JsonResponse($result);

        }


       
    }


  



   
}
