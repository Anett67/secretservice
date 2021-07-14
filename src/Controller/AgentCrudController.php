<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentCrudController extends AbstractController
{
    /**
     * @Route("/agent/creation", name="agent_create")
     */
    public function agent_create(): Response
    {

        $agent = new Agent();

        $form = $this->createForm(AgentType::class, $agent);

        return $this->render('agent_crud/agent_create.html.twig', [
            'title' => 'Agents',
            'form' => $form->createView()
        ]);
    }
}
