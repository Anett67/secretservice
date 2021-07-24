<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgentCrudController extends AbstractController
{
    /**
     * @Route("admin/agent/creation", name="agent_create")
     * @Route("admin/agent/{id}", name="agent_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function agent_create_edit(Agent $agent=null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$agent){
            $agent = new Agent();
        }
        
        $form = $this->createForm(AgentType::class, $agent);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $agent_exists = $agent->getId();

            $manager->persist($agent);
            $manager->flush();

            $this->addFlash('success', ($agent_exists) ? 'La modification a bien été effectuée.' : 'Un nouvel agent a été ajouté avec succès');

            return $this->redirectToRoute('admin_agents');

        }

        return $this->render('agent_crud/agent_create.html.twig', [
            'title' => 'Agents',
            'form' => $form->createView(),
            'edit' => $agent->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/agent/delete/{id}", name="agent_delete", methods="POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function agent_delete(Agent $agent, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $agent->getId(), $request->get('_token'))){

            if(!$agent->checkIfCanBeDeleted()){

                $this->addFlash('error', 'L\'agent est attaché à une ou plusieurs mission. Modifiez les missions avant de le supprimer.');
                return $this->redirectToRoute('admin_agents');
            }

            $entitymanager->remove($agent);
            $entitymanager->flush();
            $this->addFlash("success",  "La suppression a été effectuée");
            return $this->redirectToRoute('admin_agents');

        }
    }
}
