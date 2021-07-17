<?php

namespace App\Controller;

use App\Entity\Hideout;
use App\Form\HideoutsType;
use App\Entity\HideoutType;
use App\Form\HideoutTypeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HideoutCrudController extends AbstractController
{
    /**
     * @Route("admin/planque/creation", name="hideout_create")
     * @Route("admin/planque/{id}", name="hideout_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
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
     * @Route("/admin/hideout/{id}", name="hideout_delete", methods="delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function hideout_delete(Hideout $hideout, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $hideout->getId(), $request->get('_token'))){
            
            $entitymanager->remove($hideout);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin_hideouts');

        }
    }

    /**
     * @Route("admin/planque-type/creation", name="hideout_type_create")
     * @Route("admin/planque-type/{id}", name="hideout_type_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
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

    /**
     * @Route("/admin/hideout-type/{id}", name="hideout_type_delete", methods="delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function hideout_type_delete(HideoutType $hideout_type, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $hideout_type->getId(), $request->get('_token'))){
            
            $entitymanager->remove($hideout_type);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin_hideouts');

        }
    }
}
