<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractController
{
    /**
     * @Route("/user/create", name="user_create")
     */
    public function user_create(): Response
    {
        return $this->render('user_crud/user_create.html.twig', [
            'controller_name' => 'UserCrudController',
        ]);
    }
}
