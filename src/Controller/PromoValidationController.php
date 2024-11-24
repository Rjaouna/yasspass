<?php
// src/Controller/PromoValidationController.php
namespace App\Controller;

use App\Entity\User;
use App\Repository\EtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class PromoValidationController extends AbstractController
{
	#[Route('/promo/usage/{id}/{etablissement}', name: 'app_promo_usage', methods: ['GET'])]
	public function validatePromo(Request $request, EntityManagerInterface $em, $id, $etablissement, EtablissementRepository $etablissementRepository): Response
	{
		$user = $this->getUser(); // Récupérer l'utilisateur connecté
		$etab = $etablissementRepository->find($etablissement); // Trouver l'établissement

		if ($user && $etab) {
			// Récupérer l'adresse IP réelle de l'utilisateur
			$userIp = $request->getClientIp();

			// Mettre à jour les informations de l'utilisateur
			$user->setAdressIp($userIp); // Définir l'adresse IP
			$user->addEtablissement($etab); // Associer l'utilisateur à l'établissement (si relation définie)

			// Persister les modifications dans la base de données
			$em->persist($user);
			$em->flush();
		}

		return $this->render('passyass/index.html.twig', [
			'user' => $user,
			'etablissement' => $etab,
		]);
	}
}
