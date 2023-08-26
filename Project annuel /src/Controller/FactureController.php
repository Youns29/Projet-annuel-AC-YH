<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\FactureRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Facture')]
class FactureController extends AbstractController
{
    #[Route('/', name: 'app_Facture_index', methods: ['GET'])]
    public function index(FactureRepository $FactureRepository): Response
    {
        return $this->render('Facture/index.html.twig', [
            'Factures' => $FactureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_Facture_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        FactureRepository $FactureRepository
    ): Response {
        $Facture = new Facture();
        $form = $this->createForm(FactureType::class, $Facture);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $Facture->setCustomer($user);
            $Facture->setCreatedAt(new DateTimeImmutable('now'));
            $FactureRepository->save($Facture, true);

            return $this->redirectToRoute(
                'app_Facture_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('Facture/new.html.twig', [
            'Facture' => $Facture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Facture_show', methods: ['GET'])]
    public function show(Facture $Facture): Response
    {
        return $this->render('Facture/show.html.twig', [
            'Facture' => $Facture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_Facture_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Facture $Facture,
        FactureRepository $FactureRepository
    ): Response {
        $form = $this->createForm(FactureType::class, $Facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $FactureRepository->save($Facture, true);

            return $this->redirectToRoute(
                'app_Facture_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('Facture/edit.html.twig', [
            'Facture' => $Facture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Facture_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Facture $Facture,
        FactureRepository $FactureRepository
    ): Response {
        if (
            $this->isCsrfTokenValid(
                'delete' . $Facture->getId(),
                $request->request->get('_token')
            )
        ) {
            $FactureRepository->remove($Facture, true);
        }

        return $this->redirectToRoute(
            'app_Facture_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
