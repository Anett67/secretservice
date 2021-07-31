<?php

namespace App\Controller\Admin;

use App\Repository\AgentRepository;
use App\Repository\ContactRepository;
use App\Repository\CountryRepository;
use App\Repository\HideoutRepository;
use App\Repository\HideoutTypeRepository;
use App\Repository\MissionRepository;
use App\Repository\MissionStatusRepository;
use App\Repository\MissionTypeRepository;
use App\Repository\SpecialtyRepository;
use App\Repository\TargetRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/missions", name="admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(Request $request, PaginatorInterface $paginator, MissionRepository $mission_repository, MissionStatusRepository $mission_status_repository, MissionTypeRepository $mission_type_repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $mission_repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/missions.html.twig', [
            'title' => 'Missions',
            'missions' => $pagination,
            'mission_types' => $mission_type_repository->findAll(),
            'mission_statuses' => $mission_status_repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/agents", name="admin_agents")
     * @IsGranted("ROLE_ADMIN")
     */
    public function agents(AgentRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/Agents.html.twig', [
            'title' => 'Agents',
            'agents' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/cibles", name="admin_targets")
     * @IsGranted("ROLE_ADMIN")
     */
    public function targets(TargetRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/targets.html.twig', [
            'title' => 'Cibles',
            'targets' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/contacts", name="admin_contacts")
     * @IsGranted("ROLE_ADMIN")
     */
    public function contacts(ContactRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/contacts.html.twig', [
            'title' => 'Contacts',
            'contacts' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/planques", name="admin_hideouts")
     * @IsGranted("ROLE_ADMIN")
     */
    public function hideouts(HideoutRepository $repository, HideoutTypeRepository $hideoutTypeRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/hideouts.html.twig', [
            'title' => 'Planques',
            'hideouts' => $repository->findAll(),
            'hideoutTypes' => $hideoutTypeRepository->findAll()
        ]);
    }

    /**
     * @Route("/admin/pays", name="admin_countries")
     * @IsGranted("ROLE_ADMIN")
     */
    public function countries(CountryRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/countries.html.twig', [
            'title' => 'Pays',
            'countries' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/administrateurs", name="admin_administrators")
     * @IsGranted("ROLE_ADMIN")
     */
    public function administrators(UserRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/Administrators.html.twig', [
            'title' => 'Administrateurs',
            'users' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/specialites", name="admin_specialties")
     * @IsGranted("ROLE_ADMIN")
     */
    public function specialties(SpecialtyRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/specialties.html.twig', [
            'title' => 'Spécialités',
            'specialties' => $repository->findAll()
        ]);
    }
}
