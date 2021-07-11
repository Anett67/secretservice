<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/missions", name="admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/missions.html.twig', [
            'title' => 'Missions'
        ]);
    }

    /**
     * @Route("/admin/agents", name="admin_agents")
     * @IsGranted("ROLE_ADMIN")
     */
    public function agents(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/Agents.html.twig', [
            'title' => 'Agents'
        ]);
    }
}
