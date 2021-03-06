<?php

namespace App\Controller;

use App\Entity\DetalleReporte;
use App\Form\DetalleReporteType;
use App\Repository\DetalleReporteRepository;
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
 * @Route("/detalle/reporte")
 */
class DetalleReporteController extends AbstractController
{
    /**
     * @Route("/", name="detalle_reporte_index", methods="GET")
     */
    public function index(DetalleReporteRepository $detalleReporteRepository): Response
    {
        return $this->render('detalle_reporte/index.html.twig', ['detalle_reportes' => $detalleReporteRepository->findAll()]);
    }


         /**
     * @Route("/list/ajax", name="detalle_reportes_ajax")
     */
    public function list(Request $request)
    {

        $id = $request->request->get('id');

        //Consulta uso de SQL
        $RAW_QUERY = "select * from detalle_reporte WHERE reporte_id = '".$id."' ";

        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $detalleReportes = $statement->fetchAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $data = $serializer->serialize($detalleReportes, 'json');



       return new JsonResponse($data);


    }


    /**
     * @Route("/new", name="detalle_reporte_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $detalleReporte = new DetalleReporte();
        $form = $this->createForm(DetalleReporteType::class, $detalleReporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($detalleReporte);
            $em->flush();

            return $this->redirectToRoute('detalle_reporte_index');
        }

        return $this->render('detalle_reporte/new.html.twig', [
            'detalle_reporte' => $detalleReporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detalle_reporte_show", methods="GET")
     */
    public function show(DetalleReporte $detalleReporte): Response
    {
        return $this->render('detalle_reporte/show.html.twig', ['detalle_reporte' => $detalleReporte]);
    }

    /**
     * @Route("/{id}/edit", name="detalle_reporte_edit", methods="GET|POST")
     */
    public function edit(Request $request, DetalleReporte $detalleReporte): Response
    {
        $form = $this->createForm(DetalleReporteType::class, $detalleReporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detalle_reporte_edit', ['id' => $detalleReporte->getId()]);
        }

        return $this->render('detalle_reporte/edit.html.twig', [
            'detalle_reporte' => $detalleReporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detalle_reporte_delete", methods="DELETE")
     */
    public function delete(Request $request, DetalleReporte $detalleReporte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detalleReporte->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($detalleReporte);
            $em->flush();
        }

        return $this->redirectToRoute('detalle_reporte_index');
    }
}
