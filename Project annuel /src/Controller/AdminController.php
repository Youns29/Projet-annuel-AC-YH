<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FilterType;
use App\Form\RegistrationFormType;
use App\Repository\FactureRepository;
use App\Repository\FichierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

#[Route('/admin')]
class AdminController extends AbstractController
{
    public function __construct(protected AuthorizationCheckerInterface $authorizationChecker)
    {
    }
    #[Route('', name: 'app_admin')]
    public function index(Request $request,FactureRepository $FactureRepository, FichierRepository $FichierRepository): Response
    {
        $Factures = $FactureRepository->findByCreatedDate(10, 1);
        $Fichiers = $FichierRepository->findByCreatedDate(10, 1, 1);

        $form = $this->createForm(FilterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $limit = $form->get('limit')->getData();
            $customer = $form->get('customer')->getData();
            $customerId = $customer->getId();

        return $this->redirectToRoute('app_admin_Factures', ["limit" => $limit, "customer" => $customerId]);
        }
        return $this->render('admin/index.html.twig', [
            'Factures' => $Factures,
            'Fichiers' => $Fichiers,
            'form' => $form->createView()
        ]);

    }
    #[Route('/Factures/{limit}/{customer}', name: 'app_admin_Factures')]
    public function getFactures(FactureRepository $FactureRepository, $limit, $customer) {

        $filters = $FactureRepository->findByCreatedDate($limit, $customer);
    }
}
