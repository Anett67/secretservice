<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialtyCrudController extends AbstractController
{
    /**
     * @Route("/specialty/create", name="specialty_create")
     */
    public function specialty_create(): Response
    {
        return $this->render('specialty_crud/specialty_create.html.twig', [
            'controller_name' => 'SpecialtyCrudController',
        ]);
    }
}
