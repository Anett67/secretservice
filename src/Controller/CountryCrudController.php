<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\ContactType;
use App\Form\CountryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountryCrudController extends AbstractController
{
    /**
     * @Route("admin/pays/creation", name="country_create")
     * @Route("admin/pays/{id}", name="country_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function country_create_edit(Country $country = null, Request $request, EntityManagerInterface $manager): Response
    { 
        if(!$country){
            $country = new Country();
        }

        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $country_exists = $country->getId();
            
            $manager->persist($country);
            $manager->flush();

            $this->addFlash('success', ($country_exists) ? 'La modification a bien été effectuée.' : 'Un nouveau pays a été aujouté avec succès.');

            return $this->redirectToRoute('admin_countries');

        }

        return $this->render('country_crud/country_create.html.twig', [
            'title' => 'Pays',
            'form' => $form->createView(),
            'edit' => $country->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/country/delete/{id}", name="country_delete", methods="POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function country_delete(Country $country, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $country->getId(), $request->get('_token'))){

            if(count($country->getMissions()) || 
            count($country->getAgents()) || 
            count($country->getContacts()) || 
            count($country->getHideouts())||
            count($country->getTargets())){
                $this->addFlash('error', 'Le pays ne peut pas être supprimé.');
                return $this->redirectToRoute('admin_countries');
            }
            
            $entitymanager->remove($country);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin_countries');

        }
    }
}
