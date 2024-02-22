<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    #[Route(path: '/user-login', name: 'user_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('startpage');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route('/verify', name: 'app_verify')]
    public function verifyUser(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $token = $request->query->get('token');
        $user = $userRepository->findOneBy(['verificationToken' => $token]);

        if ($user) {
            $user->setIsVerified(true);
            $user->setVerificationToken(null);
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirect to login page or show a confirmation message
        } else {
            // Handle invalid or expired token
        }
    }
}