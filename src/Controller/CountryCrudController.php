<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryCrudController extends AbstractController
{
    /**
     * @Route("/country/crud", name="country_crud")
     */
    public function index(): Response
    {
        return $this->render('country_crud/index.html.twig', [
            'controller_name' => 'CountryCrudController',
        ]);
    }
}
