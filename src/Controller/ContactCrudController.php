<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactCrudController extends AbstractController
{
    /**
     * @Route("/contact/creation", name="contact_create")
     */
    public function contact_create(Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact();

        $form =  $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Un nouveau contact a été ajouté avec succès');

            return $this->redirectToRoute('admin_contacts');

        }

        return $this->render('contact_crud/contact_create.html.twig', [
            'title' => 'Contacts',
            'form' => $form->createView()
        ]);
    }
}
