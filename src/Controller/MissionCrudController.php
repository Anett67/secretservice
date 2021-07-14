<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionsType;
use App\Entity\MissionType;
use App\Entity\MissionStatus;
use App\Form\MissionTypeType;
use App\Form\MissionStatusType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MissionCrudController extends AbstractController
{
    /**
     * @Route("/mission/creation", name="mission_create")
     */
    public function mission_create(): Response
    {
        $mission = new Mission();

        $form = $this->createForm(MissionsType::class, $mission);

        return $this->render('mission_crud/mission_create.html.twig', [
            'controller_name' => 'MissionCrudController',
            'title' => 'Missions',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/mission-type/creation", name="mission_type_create")
     */
    public function mission_type_create(): Response
    {
        $mission_type = new MissionType();

        $form = $this->createForm(MissionTypeType::class, $mission_type);

        return $this->render('mission_crud/mission_type_create.html.twig', [
            'controller_name' => 'MissionCrudController',
            'title' => 'Missions',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/mission-status/creation", name="mission_status_create")
     */
    public function mission_status_create(): Response
    {
        $mission_status = new MissionStatus();

        $form = $this->createForm(MissionStatusType::class, $mission_status);

        return $this->render('mission_crud/mission_status_create.html.twig', [
            'title' => 'Missions',
            'form' => $form->createView()
        ]);
    }
}
