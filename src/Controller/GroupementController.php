<?php

namespace App\Controller;
use App\Dto\GroupeSearchDto;
use App\Form\DtoSearchGoupementType;
use App\Entity\Groupement;
use App\Service\GroupementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Service\GroupementExerciceService;
#[IsGranted('ROLE_SUPER_ADMIN')]
final class GroupementController extends AbstractController
{
    public function __construct(
        private readonly GroupementExerciceService $groupementService
    ) {
    }

    #[Route('/super-admin/groupements', name: 'app_groupement', methods: ['POST', 'GET'])]
    public function index(Request $request): Response
    {
        // 1. Créer le DTO
    $dto = new GroupeSearchDto();

    // 2. Créer le formulaire lié au DTO
    $form = $this->createForm(DtoSearchGoupementType::class, $dto);

    // 3. Récupérer les données envoyées
    $form->handleRequest($request);
        $groupements = $this->groupementService->findAllGroupementsAndExercicesEncours($dto);

        return $this->render('groupements/index.html.twig', [
             'controller_name' => 'GroupementController',
            'dataGroupements' => $groupements,
            'formSearchGroupement' => $form->createView(),
        ]);
    }

    
   
} 
