<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionCrudController extends AbstractController
{
    /**
     * @Route("/mission/create", name="mission_create")
     */
    public function mission_create(): Response
    {
        return $this->render('mission_crud/mission_create.html.twig', [
            'controller_name' => 'MissionCrudController',
        ]);
    }

    /**
     * @Route("/mission-type/create", name="mission_type_create")
     */
    public function mission_type_create(): Response
    {
        return $this->render('mission_crud/mission_create.html.twig', [
            'controller_name' => 'MissionCrudController',
        ]);
    }

    /**
     * @Route("/mission-status/create", name="mission_status_create")
     */
    public function mission_status_create(): Response
    {
        return $this->render('mission_crud/mission_create.html.twig', [
            'controller_name' => 'MissionCrudController',
        ]);
    }
}
