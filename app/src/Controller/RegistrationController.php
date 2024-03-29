<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'user_register')]
    public function register(Request $request,UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager,  MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setUsername($form->get('username')->getData());
            $user->setLivingCountry($form->get('livingCountry')->getData());
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setVerificationToken(rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '='));
            $entityManager->persist($user);
            $entityManager->flush();

            $hostEmail = $this->getParameter('host_email');
            $baseUrl = $this->getParameter('base_url');
            $veriUrl = $baseUrl.'/verify?token='.$user->getVerificationToken();
            $email = (new TemplatedEmail())
                ->from($hostEmail)
                ->to($user->getEmail())
                ->subject('Verification by Couch Run Gaming')
                ->htmlTemplate('email/register.html.twig')
                ->context([
                    'user' => $user,
                    'veriUrl' => $veriUrl,
                ]);
            $mailer->send($email);

            // redirect to some route
            return $this->redirectToRoute('startpage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}