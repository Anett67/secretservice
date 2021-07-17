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
     * @Route("admin/contact/creation", name="contact_create")
     * @Route("admin/contact/{id}", name="contact_edit", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     */
    public function contact_create_edit(Contact $contact = null ,Request $request, EntityManagerInterface $manager): Response
    {
        if(!$contact){
            $contact = new Contact();
        }

        $form =  $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', ($contact->getId()) ? 'La modification a bien été effectuée.' : 'Un nouveau contact a été ajouté avec succès');

            return $this->redirectToRoute('admin_contacts');

        }

        return $this->render('contact_crud/contact_create.html.twig', [
            'title' => 'Contacts',
            'form' => $form->createView(),
            'edit' => $contact->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/contact/{id}", name="contact_delete", methods="delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function contact_delete(Contact $contact, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $contact->getId(), $request->get('_token'))){
            
            $entitymanager->remove($contact);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin_contacts');

        }
    }
}
