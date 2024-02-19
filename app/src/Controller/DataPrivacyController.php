<?php

namespace App\Controller;

use App\Entity\DataPrivacy;
use App\Form\DataPrivacyType;
use App\Repository\DataPrivacyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/data/privacy')]
class DataPrivacyController extends AbstractController
{
    #[Route('/', name: 'app_data_privacy_index', methods: ['GET'])]
    public function index(DataPrivacyRepository $dataPrivacyRepository): Response
    {
        return $this->render('data_privacy/index.html.twig', [
            'data_privacies' => $dataPrivacyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_data_privacy_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dataPrivacy = new DataPrivacy();
        $form = $this->createForm(DataPrivacyType::class, $dataPrivacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dataPrivacy);
            $entityManager->flush();

            return $this->redirectToRoute('app_data_privacy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('data_privacy/new.html.twig', [
            'data_privacy' => $dataPrivacy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_data_privacy_show', methods: ['GET'])]
    public function show(DataPrivacy $dataPrivacy): Response
    {
        return $this->render('data_privacy/show.html.twig', [
            'data_privacy' => $dataPrivacy,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_data_privacy_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DataPrivacy $dataPrivacy, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DataPrivacyType::class, $dataPrivacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_data_privacy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('data_privacy/edit.html.twig', [
            'data_privacy' => $dataPrivacy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_data_privacy_delete', methods: ['POST'])]
    public function delete(Request $request, DataPrivacy $dataPrivacy, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dataPrivacy->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dataPrivacy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_data_privacy_index', [], Response::HTTP_SEE_OTHER);
    }
}
