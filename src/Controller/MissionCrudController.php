<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionsType;
use App\Entity\MissionType;
use App\Entity\MissionStatus;
use App\Form\MissionTypeType;
use App\Form\MissionStatusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MissionCrudController extends AbstractController
{
    /**
     * @Route("admin/mission/creation", name="mission_create")
     * @Route("admin/mission/{id}", name="mission_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function mission_create_edit(Mission $mission = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$mission){
            $mission = new Mission();
        }
        
        $form = $this->createForm(MissionsType::class, $mission);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $mission_exists = $mission->getId();

            $manager->persist($mission);
            $manager->flush();

            $this->addFlash('success', ($mission_exists) ? 'La modification a bien été effectuée.' : 'Une nouvelle mission a été ajouté avec succès');

            return $this->redirectToRoute('admin');

        }

        return $this->render('mission_crud/mission_create.html.twig', [
            'title' => 'Missions',
            'form' => $form->createView(),
            'edit' => $mission->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/mission/delete/{id}", name="mission_delete", methods="POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function mission_delete(Mission $mission, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $mission->getId(), $request->get('_token'))){
            
            $entitymanager->remove($mission);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin');

        }

        dd('delete');
    }

    /**
     * @Route("admin/mission-type/creation", name="mission_type_create")
     * @Route("admin/mission-type/{id}", name="mission_type_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function mission_type_create_edit(MissionType $mission_type = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$mission_type){
            $mission_type = new MissionType();
        }

        $form = $this->createForm(MissionTypeType::class, $mission_type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $mission_type_exists = $mission_type->getId();

            $manager->persist($mission_type);
            $manager->flush();

            $this->addFlash('success', ($mission_type_exists) ? 'La modification a bien été effectuée.' : 'Un nouveau type de mission a été ajouté avec succès');

            return $this->redirectToRoute('admin');
        }

        return $this->render('mission_crud/mission_type_create.html.twig', [
            'title' => 'Missions',
            'form' => $form->createView(),
            'edit'=> $mission_type->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/mission-type/delete/{id}", name="mission_type_delete", methods="POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function mission_type_delete(MissionType $mission_type, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $mission_type->getId(), $request->get('_token'))){
            
            $entitymanager->remove($mission_type);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin');

        }

    }

    /**
     * @Route("admin/mission-status/creation", name="mission_status_create")
     * @Route("admin/mission-status/{id}", name="mission_status_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function mission_status_create_edit(MissionStatus $mission_status = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$mission_status){
            $mission_status = new MissionStatus();
        }
        
        $form = $this->createForm(MissionStatusType::class, $mission_status);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $mission_status_exists = $mission_status->getId();
            
            $manager->persist($mission_status);
            $manager->flush();

            $this->addFlash('success', ($mission_status_exists) ? 'La modification a bien été effectuée.' : 'Un nouveau status a été ajouté avec succès');

            return $this->redirectToRoute('admin');
        }

        return $this->render('mission_crud/mission_status_create.html.twig', [
            'title' => 'Missions',
            'form' => $form->createView(),
            'edit' => $mission_status->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/mission-status/delete/{id}", name="mission_status_delete", methods="POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function mission_status_delete(MissionStatus $mission_status, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $mission_status->getId(), $request->get('_token'))){
            
            $entitymanager->remove($mission_status);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin');

        }
    }
}
