<?php

namespace App\Controller;

use App\Entity\ScoreBoard;
use App\Form\ScoreBoardType;
use App\Repository\ScoreBoardRepository;
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

        var_dump($request->get('game'));
        die;

        // Modify the findByGameOrdered method in your repository to implement sorting and optional filtering
        $scoreBoards = $scoreBoardRepository->findByGameOrdered(null, $category); // Replace null with actual game ID if needed

        return $this->render('score_board/index.html.twig', [
            'score_boards' => $scoreBoards
        ]);
    }

    // Create action
    #[Route('/new', name: 'score_board_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $gameId): Response
    {
        $scoreBoard = new ScoreBoard();
        $form = $this->createForm(ScoreBoardType::class, $scoreBoard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($scoreBoard);
            $entityManager->flush();

            return $this->redirectToRoute('score_board_index',  ['id' => $gameId]);
        }

        return $this->renderForm('score_board/new.html.twig', [
            'score_board' => $scoreBoard,
            'form' => $form,
            'gameId' => $gameId
        ]);
    }

    #[Route('/game/{id}/records', name: 'game_records')]
    public function gameRecords(ScoreBoardRepository $repository, int $id): Response
    {
        // Fetch records for a specific game. This returns an empty array if no records are found.
        $records = $repository->findBy(['id' => $id], ['points' => 'DESC', 'time' => 'ASC']);

        // The check below is optional since findBy should already return an empty array if no results are found.
        // However, if you want to add additional logic based on the presence of records, you can do so.
        if (!$records) {
            // Additional logic for handling no records scenario (if needed)
            // For example, setting a flash message to inform the user that no records are available.
            // $this->addFlash('info', 'No records found for this game.');
        }

        return $this->render('score_board/index.html.twig', [
            'records' => $records,
            'gameId' => $id,
        ]);
    }

    // Add other CRUD actions (edit, show, delete) here as needed
}
