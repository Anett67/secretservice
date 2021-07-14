<?php

namespace App\Controller;

use App\Entity\Specialty;
use App\Form\SpecialtyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialtyCrudController extends AbstractController
{
    /**
     * @Route("/specialite/creation", name="specialty_create")
     */
    public function specialty_create(Request $request, EntityManagerInterface $manager): Response
    {
        $specialty = new Specialty();

        $form = $this->createForm(SpecialtyType::class, $specialty);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($specialty);
            $manager->flush();

            $this->addFlash('success', 'Une nouvelle spécialité a été ajouté avec succès');

            return $this->redirectToRoute('admin_specialties');

        }

        return $this->render('specialty_crud/specialty_create.html.twig', [
            'title' => 'Spécialité',
            'form' => $form->createView()
        ]);
    }
}
