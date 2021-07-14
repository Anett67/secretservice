<?php

namespace App\Controller\Admin;

use App\Repository\CountryRepository;
use App\Repository\MissionRepository;
use App\Repository\MissionStatusRepository;
use App\Repository\MissionTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/missions", name="admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(MissionRepository $mission_repository, MissionStatusRepository $mission_status_repository, MissionTypeRepository $mission_type_repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/missions.html.twig', [
            'title' => 'Missions',
            'missions' => $mission_repository->findAll(),
            'mission_types' => $mission_type_repository->findAll(),
            'mission_statuses' => $mission_status_repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/agents", name="admin_agents")
     * @IsGranted("ROLE_ADMIN")
     */
    public function agents(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/Agents.html.twig', [
            'title' => 'Agents'
        ]);
    }

    /**
     * @Route("/admin/cibles", name="admin_targets")
     * @IsGranted("ROLE_ADMIN")
     */
    public function targets(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/targets.html.twig', [
            'title' => 'Cibles'
        ]);
    }

    /**
     * @Route("/admin/contacts", name="admin_contacts")
     * @IsGranted("ROLE_ADMIN")
     */
    public function contacts(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/contacts.html.twig', [
            'title' => 'Contacts'
        ]);
    }

    /**
     * @Route("/admin/planques", name="admin_hideouts")
     * @IsGranted("ROLE_ADMIN")
     */
    public function hideouts(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/hideouts.html.twig', [
            'title' => 'Planques'
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
    public function administrators(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/Administrators.html.twig', [
            'title' => 'Administrateurs'
        ]);
    }

    /**
     * @Route("/admin/specialites", name="admin_specialties")
     * @IsGranted("ROLE_ADMIN")
     */
    public function specialties(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/specialties.html.twig', [
            'title' => 'Spécialités'
        ]);
    }
}
