<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HideoutCrudController extends AbstractController
{
    /**
     * @Route("/hideout/crud", name="hideout_crud")
     */
    public function index(): Response
    {
        return $this->render('hideout_crud/index.html.twig', [
            'controller_name' => 'HideoutCrudController',
        ]);
    }
}
