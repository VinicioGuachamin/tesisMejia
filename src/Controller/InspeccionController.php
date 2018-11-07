<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InspeccionController extends AbstractController
{
    /**
     * @Route("/inspeccion", name="inspeccion")
     */
    public function index()
    {
        return $this->render('inspeccion/index.html.twig', [
            'controller_name' => 'InspeccionController',
        ]);
    }
}
