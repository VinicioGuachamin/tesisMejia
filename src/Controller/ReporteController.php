<?php

namespace App\Controller;

use App\Entity\Reporte;
use App\Form\ReporteType;
use App\Repository\ReporteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/reporte")
 */
class ReporteController extends AbstractController
{
    /**
     * @Route("/", name="reporte", methods="GET")
     */
    public function index(ReporteRepository $reporteRepository): Response

    {
        return $this->render('reporte/index.html.twig', [
            'reportes' => $reporteRepository->findAll()

        ]);

    }



     /**
     * @Route("/list/ajax", name="reportes_ajax")
     */
    public function list(Request $request, ReporteRepository $reporteRepository): Response
    {

        $fecha = $request->request->get('fecha');

        //Consulta uso de SQL
        $RAW_QUERY = "select * from reporte WHERE fecha = '".$fecha."' ";

        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $reportes = $statement->fetchAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $data = $serializer->serialize($reportes, 'json');

 
        return new JsonResponse($data);

        

    }






    /**
     * @Route("/new", name="reporte_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $reporte = new Reporte();
        $form = $this->createForm(ReporteType::class, $reporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reporte);
            $em->flush();

            return $this->redirectToRoute('reporte_index');
        }

        return $this->render('reporte/new.html.twig', [
            'reporte' => $reporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reporte_show", methods="GET")
     */
    public function show(Reporte $reporte): Response
    {
        return $this->render('reporte/show.html.twig', ['reporte' => $reporte]);
    }

    /**
     * @Route("/{id}/edit", name="reporte_edit", methods="GET|POST")
     */
    public function edit(Request $request, Reporte $reporte): Response
    {
        $form = $this->createForm(ReporteType::class, $reporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reporte_edit', ['id' => $reporte->getId()]);
        }

        return $this->render('reporte/edit.html.twig', [
            'reporte' => $reporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reporte_delete", methods="DELETE")
     */
    public function delete(Request $request, Reporte $reporte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reporte->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reporte);
            $em->flush();
        }

        return $this->redirectToRoute('reporte_index');
    }
}
