<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\ScoreBoard;
use App\Form\ScoreBoardType;
use App\Repository\GameRepository;
use App\Repository\ScoreBoardRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/scoreboard')]
class ScoreBoardController extends AbstractController
{
    // List action with sorting and optional filtering by category
    #[Route('/', name: 'score_board_index', methods: ['GET'])]
    public function index(ScoreBoardRepository $scoreBoardRepository, Request $request): Response
    {
        $category = $request->query->get('category');

        // Modify the findByGameOrdered method in your repository to implement sorting and optional filtering
        $scoreBoards = $scoreBoardRepository->findByGameOrdered(null, $category); // Replace null with actual game ID if needed

        return $this->render('score_board/index.html.twig', [
            'score_boards' => $scoreBoards
        ]);
    }

    // Create action
    #[Route('/new/{gameId?}', name: 'score_board_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        GameRepository $gameRepository,
        UserRepository $userRepository,
        int $gameId
    ): Response {
        $scoreBoard = new ScoreBoard();
        $form = $this->createForm(ScoreBoardType::class, $scoreBoard);
        $form->handleRequest($request);
        $game = $gameRepository->findOneBy(['id' => $gameId]);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->getUser()) {
                $scoreBoard->setPlayer($this->getUser());
            } else {
                $guestUser = $userRepository->findOneBy(['username' => 'Guest']);
                if (!$guestUser) {
                    // Handle case where Guest user isn't found, which should be rare
                }
                $scoreBoard->setPlayer($guestUser);
            }
            $today = new \DateTime();
            $scoreBoard->setPublishDate($today);
            $scoreBoard->setGame($game);
            $entityManager->persist($scoreBoard);
            $entityManager->flush();

            return $this->redirectToRoute('game_records', ['gameId' => $gameId]);
        }

        return $this->renderForm('score_board/new.html.twig', [
            'score_board' => $scoreBoard,
            'form' => $form,
            'gameId' => $gameId
        ]);
    }

    #[Route('/game/{gameId}/records', name: 'game_records')]
    public function gameRecords(ScoreBoardRepository $repository, int $gameId): Response
    {
        // Fetch records for a specific game. This returns an empty array if no records are found.
        $records = $repository->findByGameOrdered(['game' => $gameId]);

        // The check below is optional since findBy should already return an empty array if no results are found.
        // However, if you want to add additional logic based on the presence of records, you can do so.
        if (!$records) {
            // Additional logic for handling no records scenario (if needed)
            // For example, setting a flash message to inform the user that no records are available.
            // $this->addFlash('info', 'No records found for this game.');
        }

        return $this->render('score_board/index.html.twig', [
            'records' => $records,
            'gameId' => $gameId,
        ]);
    }

    // Add other CRUD actions (edit, show, delete) here as needed
}
