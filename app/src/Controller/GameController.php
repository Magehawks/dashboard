<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(): Response
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    #[Route('/games', name: 'game_list')]
    public function list(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();

        return $this->render('game/list.html.twig', [
            'games' => $games,
        ]);
    }
}
