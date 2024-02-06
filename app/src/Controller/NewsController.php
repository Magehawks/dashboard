<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(Environment $twig, NewsRepository $newsRepository): Response
    {
        return new Response($twig->render('news/index.html.twig', [
            'items' => $newsRepository->findAll()
        ]));
    }
}
