<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ARTISANController extends AbstractController
{
    #[Route('/a/r/t/i/s/a/n', name: 'app_a_r_t_i_s_a_n')]
    public function index(): Response
    {
        return $this->render('artisan/index.html.twig', [
            'controller_name' => 'ARTISANController',
        ]);
    }
}
