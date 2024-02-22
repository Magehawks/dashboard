<?php

namespace App\Controller;

use App\Repository\ScoreBoardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(ScoreBoardRepository $scoreBoardRepository): Response
    {
        // Assuming you have a method to get the current user and their records
        $user = $this->getUser(); // Get the current user

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Fetch records for the user, clustered by games
        // This is pseudocode; adjust according to your application's structure
        $recordsByGame =$scoreBoardRepository->findRecordsByUser($user);

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'recordsByGame' => $recordsByGame,
        ]);
    }
}
