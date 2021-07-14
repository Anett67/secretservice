<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialtyCrudController extends AbstractController
{
    /**
     * @Route("/specialty/crud", name="specialty_crud")
     */
    public function index(): Response
    {
        return $this->render('specialty_crud/index.html.twig', [
            'controller_name' => 'SpecialtyCrudController',
        ]);
    }
}
