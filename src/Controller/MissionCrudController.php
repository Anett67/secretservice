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
    public function create(): Response
    {
        return $this->render('mission_crud/mission_create.html.twig', [
            'controller_name' => 'MissionCrudController',
        ]);
    }
}
