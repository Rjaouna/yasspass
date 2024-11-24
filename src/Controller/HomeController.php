<?php

namespace App\Controller;

use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(Request $request, EtablissementRepository $etablissementRepository): Response
    {
        $session = $request->getSession();
        $themeCss = $session->get('themeCss', 'default'); // Thème par défaut : "default"
        // Récupérer toutes les bannières depuis le repository
        $banners = $etablissementRepository->findAll();

        return $this->render('home/index.html.twig', [
            'themeCss' => $themeCss,
            'banners' => $banners,
        ]);
    }
}
