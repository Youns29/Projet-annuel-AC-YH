<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Category;


#[Route('/')]
class HomeController extends AbstractController
{
    public function __construct(
        protected ManagerRegistry $registery,
        protected UserPasswordHasherInterface $encoder
    ){

    }
    #[Route('', name: 'app_home')]
    public function index(ManagerRegistry $registry): Response
    {
        $FactureRepository= $this->registery->getRepository(
            Facture::class
        );
        $Factures= $FactureRepository->find(1);

        $FactureTitle = $Factures->getTitle();
#        dd($Factures);
        return $this->render('home/index.html.twig', [
            'Factures' => $Factures,
            'FactureTitle' => $FactureTitle,
        ]);
}

}
