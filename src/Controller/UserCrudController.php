<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Date;

class UserCrudController extends AbstractController
{
    /**
     * @Route("admin/administrateur/creation", name="user_create")
     * @Route("admin/administrateur/{id}", name="user_edit", methods="GET|POST")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function user_create_edit(User $user = null, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if(!$user){
            $user = new User();
        }
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user_exists = $user->getId();

            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setCreatedAt(new DateTimeImmutable());

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', ($user_exists) ? 'La modification a bien été effectuée.' : 'Un administrateur a été ajouté avec succèes');

            return $this->redirectToRoute('admin_administrators');
        }

        return $this->render('user_crud/user_create.html.twig', [
            'title' => 'Administrateur',
            'form' => $form->createView(),
            'edit' => $user->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/administrator/delete/{id}", name="user_delete", methods="POST")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function user_delete(User $user, Request $request, EntityManagerInterface $entitymanager){

        if($this->isCsrfTokenValid('SUP' . $user->getId(), $request->get('_token'))){
            
            $entitymanager->remove($user);
            $entitymanager->flush();
            $this->addFlash("success", "La suppression a été effectuée");
            return $this->redirectToRoute('admin_users');

        }
    }
}
