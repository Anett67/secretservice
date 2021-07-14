<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactCrudController extends AbstractController
{
    /**
     * @Route("/contact/create", name="contact_create")
     */
    public function contact_create(): Response
    {
        return $this->render('contact_crud/contact_create.html.twig', [
            'controller_name' => 'ContactCrudController',
        ]);
    }
}
