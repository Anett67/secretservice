<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetCrudController extends AbstractController
{
    /**
     * @Route("/target/crud", name="target_crud")
     */
    public function index(): Response
    {
        return $this->render('target_crud/index.html.twig', [
            'controller_name' => 'TargetCrudController',
        ]);
    }
}
