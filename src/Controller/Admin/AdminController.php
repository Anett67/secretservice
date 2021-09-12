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
            $mission_repository->findAllWithPagination(),
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
    public function agents(AgentRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $repository->findAllWithPagination(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/agents.html.twig', [
            'title' => 'Agents',
            'agents' => $pagination
        ]);
    }

    /**
     * @Route("/admin/cibles", name="admin_targets")
     * @IsGranted("ROLE_ADMIN")
     */
    public function targets(TargetRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $repository->findAllWithPagination(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/targets.html.twig', [
            'title' => 'Cibles',
            'targets' => $pagination
        ]);
    }

    /**
     * @Route("/admin/contacts", name="admin_contacts")
     * @IsGranted("ROLE_ADMIN")
     */
    public function contacts(ContactRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $repository->findAllWithPagination(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/contacts.html.twig', [
            'title' => 'Contacts',
            'contacts' => $pagination
        ]);
    }

    /**
     * @Route("/admin/planques", name="admin_hideouts")
     * @IsGranted("ROLE_ADMIN")
     */
    public function hideouts(HideoutRepository $repository, HideoutTypeRepository $hideoutTypeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $repository->findAllWithPagination(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/hideouts.html.twig', [
            'title' => 'Planques',
            'hideouts' => $pagination,
            'hideoutTypes' => $hideoutTypeRepository->findAll()
        ]);
    }

    /**
     * @Route("/admin/pays", name="admin_countries")
     * @IsGranted("ROLE_ADMIN")
     */
    public function countries(CountryRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/countries.html.twig', [
            'title' => 'Pays',
            'countries' => $pagination
        ]);
    }

    /**
     * @Route("/admin/administrateurs", name="admin_administrators")
     * @IsGranted("ROLE_ADMIN")
     */
    public function administrators(UserRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/administrators.html.twig', [
            'title' => 'Administrateurs',
            'users' => $pagination
        ]);
    }

    /**
     * @Route("/admin/specialites", name="admin_specialties")
     * @IsGranted("ROLE_ADMIN")
     */
    public function specialties(SpecialtyRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pagination = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/specialties.html.twig', [
            'title' => 'Spécialités',
            'specialties' => $pagination
        ]);
    }
}
