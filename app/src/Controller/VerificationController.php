<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends AbstractController
{
    #[Route(path: "/verify",name: "app_verify")]
    public function verifyUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $token = $request->query->get('token');

        if (!$token) {
            // Handle error or redirect
            return $this->redirectToRoute('startpage');
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['verificationToken' => $token]);

        if (!$user) {
            // Handle error or redirect
            return $this->redirectToRoute('startpage');
        }

        $user->setIsVerified(true);
        $user->setIsRegistered(true);
        $user->setVerificationToken(null); // Clear the verification token
        $entityManager->persist($user);
        $entityManager->flush();

        // Handle successful verification
        // For example, log the user in and redirect to the dashboard
        return $this->redirectToRoute('startpage');
    }
}