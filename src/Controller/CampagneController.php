<?php
namespace App\Controller;

use App\Service\CampagneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class CampagneController extends AbstractController
{
    public function __construct(
        private readonly CampagneService $campagneService
    ) {
    }

    #[Route('/super-admin/campagnes', name: 'app_campagne', methods: ['GET'])]
    public function index(): Response
    {
        $campagnes = $this->campagneService->getListeCampagnes();

        return $this->render('campagne/index.html.twig', [
            'dataCampagnes' => $campagnes,
        ]);
    }
}
