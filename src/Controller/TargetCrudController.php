<?php

namespace App\Controller;

use App\Entity\Target;
use App\Form\TargetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetCrudController extends AbstractController
{
    /**
     * @Route("/cible/creation", name="target_create")
     */
    public function target_create(Request $request, EntityManagerInterface $manager): Response
    {
        $target = new Target();

        $form = $this->createForm(TargetType::class, $target);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($target);
            $manager->flush();

            $this->addFlash('success', 'Un nouveau cible a été ajouté avec succès');

            return $this->redirectToRoute('admin_targets');

        }

        return $this->render('target_crud/target_create.html.twig', [
            'title' => 'Cibles',
            'form' => $form->createView()
        ]);
    }
}
