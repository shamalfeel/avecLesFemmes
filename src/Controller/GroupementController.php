<?php

namespace App\Controller;

use App\Entity\Groupement;
use App\Service\GroupementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_SUPER_ADMIN')]
final class GroupementController extends AbstractController
{
    public function __construct(
        private readonly GroupementService $groupementService
    ) {
    }

    #[Route('/super-admin/groupements', name: 'app_groupement', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $valeur = $request->query->get('q');
        $groupements = $this->groupementService->getListeGroupements($valeur);

        return $this->render('groupements/index.html.twig', [
            'controller_name' => 'GroupementController',
            'dataGroupements' => $groupements,
        ]);
    }

    #[Route('/super-admin/groupements/{id}', name: 'app_groupement_show', methods: ['GET'])]
    public function show(Groupement $groupement): Response
    {
        return $this->render('groupements/show.html.twig', [
            'groupement' => $groupement,
        ]);
    }
   
} 
