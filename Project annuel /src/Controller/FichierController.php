<?php

namespace App\Controller;

use App\Entity\Fichier;
use App\Form\FichierType;
use App\Repository\FichierRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Fichier')]
class FichierController extends AbstractController
{
    #[Route('/', name: 'app_Fichier_index', methods: ['GET'])]
    public function index(FichierRepository $FichierRepository): Response
    {
        return $this->render('Fichier/index.html.twig', [
            'Fichiers' => $FichierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_Fichier_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        FichierRepository $FichierRepository
    ): Response {
        $Fichier = new Fichier();
        $form = $this->createForm(FichierType::class, $Fichier);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $Fichier->setSeller($user);
            $Fichier->setCreatedAt(new DateTimeImmutable('now'));

            $FichierRepository->save($Fichier, true);

            return $this->redirectToRoute(
                'app_Fichier_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('Fichier/new.html.twig', [
            'Fichier' => $Fichier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Fichier_show', methods: ['GET'])]
    public function show(Fichier $Fichier): Response
    {
        return $this->render('Fichier/show.html.twig', [
            'Fichier' => $Fichier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_Fichier_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Fichier $Fichier,
        FichierRepository $FichierRepository
    ): Response {
        $form = $this->createForm(FichierType::class, $Fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Fichier->setUpdatedAt(new DateTimeImmutable('now'));
            $FichierRepository->save($Fichier, true);

            return $this->redirectToRoute(
                'app_Fichier_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('Fichier/edit.html.twig', [
            'Fichier' => $Fichier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Fichier_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Fichier $Fichier,
        FichierRepository $FichierRepository
    ): Response {
        if (
            $this->isCsrfTokenValid(
                'delete' . $Fichier->getId(),
                $request->request->get('_token')
            )
        ) {
            $FichierRepository->remove($Fichier, true);
        }

        return $this->redirectToRoute(
            'app_Fichier_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
