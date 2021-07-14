<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentCrudController extends AbstractController
{
    /**
     * @Route("/agent/create", name="agent_create")
     */
    public function agent_create(): Response
    {
        return $this->render('agent_crud/agent_create.html.twig', [
            'controller_name' => 'AgentCrudController',
            'title' => 'Agents'
        ]);
    }
}
