<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MissionController extends AbstractController
{

    /**
     * @Route("/", name="missions")
     */
    public function index(MissionRepository $missionRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $missionRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        
        return $this->render('mission/index.html.twig', [
            'missions' => $pagination
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
