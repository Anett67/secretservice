<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractController
{
    /**
     * @Route("/administrateur/creation", name="user_create")
     */
    public function user_create(): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        return $this->render('user_crud/user_create.html.twig', [
            'title' => 'Administrateur',
            'form' => $form->createView()
        ]);
    }
}
