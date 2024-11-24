<?php

namespace App\Controller;

use App\Service\ThemeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class DefaultController extends AbstractController
{
	#[Route('/default', name: 'app_home')]
	public function index(ThemeManager $themeManager): Response
	{
		$activeTheme = $themeManager->getActiveTheme();

		return $this->render('base.html.twig', [
			'themeCss' => $activeTheme,
		]);
	}
}
