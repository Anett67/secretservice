<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{

    /**
     * @Route("/", name="missions")
     */
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('mission/index.html.twig', [
            'missions' => $missionRepository->findAll()
        ]);
    }

    /**
     * @Route("/mission/{id}", name="single-mission", requirements={"id":"\d+"})
     */
    public function mission(Mission $mission){

        return $this->render('mission/mission.html.twig', [
            'mission' => $mission
        ]);
    }
}
