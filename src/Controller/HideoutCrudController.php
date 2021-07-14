<?php

namespace App\Controller;

use App\Entity\Hideout;
use App\Form\HideoutsType;
use App\Entity\HideoutType;
use App\Form\HideoutTypeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HideoutCrudController extends AbstractController
{
    /**
     * @Route("/planque/creation", name="hideout_create")
     */
    public function hideout_create_create(Request $request, EntityManagerInterface $manager): Response
    {
        $hideout = new Hideout();

        $form = $this->createForm(HideoutsType::class, $hideout);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($hideout);
            $manager->flush();

            $this->addFlash('success', 'Une nouvelle planque a été ajouté avec succès');

            return $this->redirectToRoute('admin_hideouts');

        }

        return $this->render('hideout_crud/hideout_create.html.twig', [
            'title' => 'Planques',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/planque-type/creation", name="hideout_type_create")
     */
    public function hideout_type_create(Request $request, EntityManagerInterface $manager): Response
    {
        $hideout_type = new HideoutType();

        $form = $this->createForm(HideoutTypeType::class, $hideout_type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($hideout_type);
            $manager->flush();

            $this->addFlash('success', 'Un nouveau type de planque a été ajouté avec succès');

            return $this->redirectToRoute('admin_hideouts');

        }

        return $this->render('hideout_crud/hideout_type_create.html.twig', [
            'title' => 'Planques',
            'form' => $form->createView()
        ]);
    }
}
