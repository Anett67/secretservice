<?php

namespace App\Controller;

use App\Entity\Specialty;
use App\Form\SpecialtyType;
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
        $specialty = new Specialty();

        $form = $this->createForm(SpecialtyType::class, $specialty);

        return $this->render('specialty_crud/specialty_create.html.twig', [
            'controller_name' => 'SpecialtyCrudController',
            'title' => 'Spécialité',
            'form' => $form->createView()
        ]);
    }
}
