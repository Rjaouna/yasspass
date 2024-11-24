<?php

// src/Controller/SettingsController.php
namespace App\Controller;

use App\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class SettingsController extends AbstractController
{
    #[Route('/admin/settings', name: 'app_settings')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $themeCss = $session->get('themeCss', 'default'); // Thème par défaut : "default"
        $form = $this->createForm(SettingsType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $theme = $form->get('theme')->getData();
            $session = $request->getSession();
            $session->set('themeCss', $theme);

            return $this->redirectToRoute('app_settings');
        }

        return $this->render('settings/index.html.twig', [
            'form' => $form->createView(),
            'themeCss' => $themeCss,

        ]);
    }
}
