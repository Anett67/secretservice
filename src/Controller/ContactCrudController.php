<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
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
        $contact = new Contact();

        $form =  $this->createForm(ContactType::class, $contact);

        return $this->render('contact_crud/contact_create.html.twig', [
            'controller_name' => 'ContactCrudController',
            'title' => 'Contacts',
            'form' => $form->createView()
        ]);
    }
}
