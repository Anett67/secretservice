<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentCrudController extends AbstractController
{
    /**
     * @Route("/agent/crud", name="agent_crud")
     */
    public function index(): Response
    {
        return $this->render('agent_crud/index.html.twig', [
            'controller_name' => 'AgentCrudController',
        ]);
    }
}
