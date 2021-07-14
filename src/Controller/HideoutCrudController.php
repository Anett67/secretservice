<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HideoutCrudController extends AbstractController
{
    /**
     * @Route("/hideout/create", name="hideout_create")
     */
    public function hideout_create_create(): Response
    {
        return $this->render('hideout_crud/hideout_create.html.twig', [
            'controller_name' => 'HideoutCrudController',
            'title' => 'Planques'
        ]);
    }

    /**
     * @Route("/hideout-type/create", name="hideout_type_create")
     */
    public function hideout_type_create(): Response
    {
        return $this->render('hideout_crud/hideout_type_create.html.twig', [
            'controller_name' => 'HideoutCrudController',
            'title' => 'Planques'
        ]);
    }
}
