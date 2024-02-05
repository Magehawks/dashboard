<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use App\Service\DashboardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, DashboardService $dashboardService): Response
    {
         return new Response($twig->render('dashboard/index.html.twig', [
             'items' => $dashboardService->collectAllNews(),
             'controller_name' => 'DashboardController',
         ]));
    }
}
