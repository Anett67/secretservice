<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\ContactType;
use App\Form\CountryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryCrudController extends AbstractController
{
    /**
     * @Route("/pays/creation", name="country_create")
     */
    public function country_create(Request $request, EntityManagerInterface $manager): Response
    {
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($country);
            $manager->flush();

            $this->addFlash('success', 'Un nouveau pays a été aujouté avec succès.');

            return $this->redirectToRoute('admin_countries');

        }

        return $this->render('country_crud/country_create.html.twig', [
            'title' => 'Pays',
            'form' => $form->createView()
        ]);
    }
}
