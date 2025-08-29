<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(\App\Repository\BrandRepository $brandRepository): Response
    {
        $brands = $brandRepository->findAll();
        return $this->render('homePage/index.html.twig', [
            'controller_name' => 'HomePageController',
            'brands' => $brands,
        ]);
    }
}
