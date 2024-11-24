<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Repository\EtablissementRepository;
use App\Service\PromoCodeGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class PromoCodeController extends AbstractController
{
	#[Route('/etablissement/{id}/generate-promo', name: 'generate_promo_code', methods: ['POST'])]
	public function generatePromoCode(
		Etablissement $etablissement,
		PromoCodeGenerator $promoCodeGenerator,
		EntityManagerInterface $entityManager
	): JsonResponse {
		// Génération d'un nouveau code promo
		$newPromoCode = $promoCodeGenerator->generate();

		// Mise à jour de l'établissement avec le nouveau code promo
		$etablissement->setPromoCode($newPromoCode);
		$entityManager->flush();

		return new JsonResponse([
			'success' => true,
			'promoCode' => $newPromoCode,
		]);
	}
}
