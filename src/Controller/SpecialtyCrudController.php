<?php

namespace App\Controller;

use App\Entity\Specialty;
use App\Form\SpecialtyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpecialtyCrudController extends AbstractController
{
    /**
     * @Route("admin/specialite/creation", name="specialty_create")
     * @Route("admin/specialite/{id}", name="specialty_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function specialty_create_edit(Specialty $specialty = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$specialty){
            $specialty = new Specialty();
        }
        
        $form = $this->createForm(SpecialtyType::class, $specialty);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $specialty_exists = $specialty->getId();

            $manager->persist($specialty);
            $manager->flush();

            $this->addFlash('success', ($specialty_exists) ? 'La modification a bien été effectuée.' : 'Une nouvelle spécialité a été ajouté avec succès');

            return $this->redirectToRoute('admin_specialties');

        }

        return $this->render('specialty_crud/specialty_create.html.twig', [
            'title' => 'Spécialité',
            'form' => $form->createView(),
            'edit' => $specialty->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/specialty/delete/{id}", name="specialty_delete", methods="POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function specialty_delete(Specialty $specialty, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $specialty->getId(), $request->get('_token'))){
            
            $entitymanager->remove($specialty);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin_specialties');

        }
    }
}
