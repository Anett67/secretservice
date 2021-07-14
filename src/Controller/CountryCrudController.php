<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\ContactType;
use App\Form\CountryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryCrudController extends AbstractController
{
    /**
     * @Route("/pays/creation", name="country_create")
     */
    public function country_create(): Response
    {
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country);

        return $this->render('country_crud/country_create.html.twig', [
            'title' => 'Pays',
            'form' => $form->createView()
        ]);
    }
}
