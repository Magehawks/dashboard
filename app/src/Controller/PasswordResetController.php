<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PasswordResetController extends AbstractController
{
    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function request(Request $request,UserRepository $userRepository, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        // Handle the form submission...
        /** @var User $user */
        $user = $userRepository->findOneBy(['email' => $request->get('email')]);
        $token = $tokenGenerator->generateToken();
        $hostEmail = $this->getParameter('host_email');
        $baseUrl = $this->getParameter('base_url');
        $user->setResetToken($token);
        $user->setResetTokenExpiresAt(new \DateTime('+1 hour'));

        // Persist the token and expiration date in the database...

        // Send the email with the reset link
        $email = (new Email())
            ->from($hostEmail)
            ->to($user->getEmail())
            ->subject('Your password reset request')
            ->html('Here is the link to reset your password: <a href="' . $baseUrl . '/reset-password?token=' . $token . '">Reset Password</a>');

        $mailer->send($email);

        // Redirect or inform the user that the email has been sent
    }
}