<?php

namespace App\Controller;

use App\Repository\EtablissementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class PromoController extends AbstractController
{
	#[Route('/validate-promo', name: 'validate_promo', methods: ['GET', 'POST'])]
	public function validatePromo(Request $request, EtablissementRepository $etablissementRepository): Response
	{
		$message = '';
		$message_color = 'black';
		$etablissement = null; // Initialise l'établissement à null

		if ($request->isMethod('POST')) {
			// Récupération du code promo envoyé dans le formulaire
			$promoCode = $request->request->get('promoCode');

			if (!$promoCode) {
				$message = 'Code promo non fourni.';
				$message_color = 'red';
			} else {
				// Recherche de l'établissement par le code promo
				$etablissement = $etablissementRepository->findOneBy(['promo_code' => $promoCode]);

				if ($etablissement) {
					$message = 'Code promo est valide : ' . $etablissement->getName();
					$message_color = 'green';
				} else {
					$message = 'Code promo invalide.';
					$message_color = 'red';
				}
			}
		}

		return $this->render('promo_validation/promo_validation.html.twig', [
			'message' => $message,
			'message_color' => $message_color,
			'etablissement' => $etablissement,  // Passe l'établissement au template
		]);
	}
}
