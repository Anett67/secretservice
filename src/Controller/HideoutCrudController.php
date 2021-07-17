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
     * @Route("admin/planque/creation", name="hideout_create")
     * @Route("admin/planque/{id}", name="hideout_edit", methods="GET|POST")
     */
    public function hideout_create_edit(Hideout $hideout = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$hideout){
            $hideout = new Hideout();
        }
        
        $form = $this->createForm(HideoutsType::class, $hideout);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($hideout);
            $manager->flush();

            $this->addFlash('success', ($hideout->getId()) ? 'La modification a bien été effectuée.' : 'Une nouvelle planque a été ajouté avec succès');

            return $this->redirectToRoute('admin_hideouts');
        }

        return $this->render('hideout_crud/hideout_create.html.twig', [
            'title' => 'Planques',
            'form' => $form->createView(),
            'edit' => $hideout->getId() !== null
        ]);
    }

    /**
     * @Route("admin/planque-type/creation", name="hideout_type_create")
     * @Route("admin/planque-type/{id}", name="hideout_type_edit", methods="GET|POST")
     */
    public function hideout_type_create_edit(HideoutType $hideout_type = null , Request $request, EntityManagerInterface $manager): Response
    {
        if(!$hideout_type){
            $hideout_type = new HideoutType();
        }
        
        $form = $this->createForm(HideoutTypeType::class, $hideout_type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($hideout_type);
            $manager->flush();

            $this->addFlash('success', ($hideout_type->getId()) ? 'La modification a bien été effectuée.' : 'Un nouveau type de planque a été ajouté avec succès');

            return $this->redirectToRoute('admin_hideouts');

        }

        return $this->render('hideout_crud/hideout_type_create.html.twig', [
            'title' => 'Planques',
            'form' => $form->createView(),
            'edit' => $hideout_type->getId() !== null
        ]);
    }
}
