<?php

namespace App\Controller;

use App\Entity\TypeEtablissement;
use App\Form\TypeEtablissementType;
use App\Repository\TypeEtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/etablissement')]
final class TypeEtablissementController extends AbstractController
{
    #[Route(name: 'app_type_etablissement_index', methods: ['GET'])]
    public function index(TypeEtablissementRepository $typeEtablissementRepository): Response
    {
        return $this->render('type_etablissement/index.html.twig', [
            'type_etablissements' => $typeEtablissementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeEtablissement = new TypeEtablissement();
        $form = $this->createForm(TypeEtablissementType::class, $typeEtablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeEtablissement);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_etablissement/new.html.twig', [
            'type_etablissement' => $typeEtablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_etablissement_show', methods: ['GET'])]
    public function show(TypeEtablissement $typeEtablissement): Response
    {
        return $this->render('type_etablissement/show.html.twig', [
            'type_etablissement' => $typeEtablissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeEtablissement $typeEtablissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeEtablissementType::class, $typeEtablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_etablissement/edit.html.twig', [
            'type_etablissement' => $typeEtablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, TypeEtablissement $typeEtablissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeEtablissement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typeEtablissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
