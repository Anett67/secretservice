<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{

    /**
     * @Route("/", name="missions")
     */
    public function index(): Response
    {

        return $this->render('mission/index.html.twig', [
            'controller_name' => 'MissionController',
        ]);
    }
}
