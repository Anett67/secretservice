<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionCrudController extends AbstractController
{
    /**
     * @Route("/mission/crud", name="mission_crud")
     */
    public function index(): Response
    {
        return $this->render('mission_crud/index.html.twig', [
            'controller_name' => 'MissionCrudController',
        ]);
    }
}
