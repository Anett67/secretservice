<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentCrudController extends AbstractController
{
    /**
     * @Route("admin/agent/creation", name="agent_create")
     * @Route("admin/agent/{id}", name="agent_edit", methods="GET|POST")
     */
    public function agent_create_edit(Agent $agent=null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$agent){
            $agent = new Agent();
        }
        
        $form = $this->createForm(AgentType::class, $agent);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($agent);
            $manager->flush();

            $this->addFlash('success', ($agent->getId()) ? 'La modification a bien été effectuée.' : 'Un nouvel agent a été ajouté avec succès');

            return $this->redirectToRoute('admin_agents');

        }

        return $this->render('agent_crud/agent_create.html.twig', [
            'title' => 'Agents',
            'form' => $form->createView(),
            'edit' => $agent->getId() !== null
        ]);
    }
}
