<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class ThemeController extends AbstractController
{
	#[Route('/change-theme/{theme}', name: 'app_change_theme')]
	public function changeTheme(string $theme, Request $request): Response
	{
		$session = $request->getSession();
		$themeCss = $session->get('themeCss', 'default'); // Thème par défaut : "default"
		$session = $request->getSession();
		$session->set('themeCss', $theme);

		// Redirigez l'utilisateur après le changement
		return $this->redirectToRoute(
			'app_homepage',
			[
				'themeCss' => $themeCss,

			]
		);
	}
}
