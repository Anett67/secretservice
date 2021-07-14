<?php

namespace App\Controller;

use App\Entity\Hideout;
use App\Entity\HideoutType;
use App\Form\HideoutType as FormHideoutType;
use App\Form\HideoutTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HideoutCrudController extends AbstractController
{
    /**
     * @Route("/planque/creation", name="hideout_create")
     */
    public function hideout_create_create(): Response
    {

        $hideout = new Hideout();

        $form = $this->createForm(FormHideoutType::class, $hideout);

        return $this->render('hideout_crud/hideout_create.html.twig', [
            'controller_name' => 'HideoutCrudController',
            'title' => 'Planques',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/planque-type/creation", name="hideout_type_create")
     */
    public function hideout_type_create(): Response
    {
        $hideout_type = new HideoutType();

        $form = $this->createForm(HideoutTypeType::class, $hideout_type);

        return $this->render('hideout_crud/hideout_type_create.html.twig', [
            'controller_name' => 'HideoutCrudController',
            'title' => 'Planques',
            'form' => $form->createView()
        ]);
    }
}
