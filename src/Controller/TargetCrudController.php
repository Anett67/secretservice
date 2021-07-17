<?php

namespace App\Controller;

use App\Entity\Target;
use App\Form\TargetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TargetCrudController extends AbstractController
{
    /**
     * @Route("admin/cible/creation", name="target_create")
     * @Route("admin/cible/{id}", name="target_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function target_create_edit(Target $target = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$target){
            $target = new Target();
        }
        
        $form = $this->createForm(TargetType::class, $target);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($target);
            $manager->flush();

            $this->addFlash('success', ($target->getId()) ? 'La modification a bien été effectuée.' : 'Un nouveau cible a été ajouté avec succès');

            return $this->redirectToRoute('admin_targets');

        }

        return $this->render('target_crud/target_create.html.twig', [
            'title' => 'Cibles',
            'form' => $form->createView(),
            'edit' => $target->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/target/delete/{id}", name="target_delete", methods="POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function target_delete(Target $target, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $target->getId(), $request->get('_token'))){
            
            $entitymanager->remove($target);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin_targets');

        }
    }
}
