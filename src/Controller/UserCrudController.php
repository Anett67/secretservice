<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use SebastianBergmann\CodeCoverage\Percentage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractController
{
    /**
     * @Route("admin/administrateur/creation", name="user_create")
     * @Route("admin/administrateur/{id}", name="user_edit", methods="GET|POST")
     */
    public function user_create_edit(User $user = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$user){
            $user = new User();
        }
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', ($user->getId()) ? 'La modification a bien été effectuée.' : 'Un administrateur a été ajouté avec succèes');

            return $this->redirectToRoute('admin_administrators');
        }

        return $this->render('user_crud/user_create.html.twig', [
            'title' => 'Administrateur',
            'form' => $form->createView(),
            'edit' => $user->getId() !== null
        ]);
    }
}
