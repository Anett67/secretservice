<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryCrudController extends AbstractController
{
    /**
     * @Route("/country/create", name="country_create")
     */
    public function country_create(): Response
    {
        return $this->render('country_crud/country_create.html.twig', [
            'controller_name' => 'CountryCrudController',
            'title' => 'Pays'
        ]);
    }
}
