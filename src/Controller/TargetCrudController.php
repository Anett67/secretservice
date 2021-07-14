<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetCrudController extends AbstractController
{
    /**
     * @Route("/target/create", name="target_create")
     */
    public function target_create(): Response
    {
        return $this->render('target_crud/target_create.html.twig', [
            'controller_name' => 'TargetCrudController',
        ]);
    }
}
