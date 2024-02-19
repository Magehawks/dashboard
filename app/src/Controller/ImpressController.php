<?php

namespace App\Controller;

use App\Entity\Impress;
use App\Form\ImpressType;
use App\Repository\ImpressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/impress')]
class ImpressController extends AbstractController
{
    #[Route('/', name: 'app_impress_index', methods: ['GET'])]
    public function index(ImpressRepository $impressRepository): Response
    {
        return $this->render('impress/index.html.twig', [
            'impresses' => $impressRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_impress_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $impress = new Impress();
        $form = $this->createForm(ImpressType::class, $impress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($impress);
            $entityManager->flush();

            return $this->redirectToRoute('app_impress_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('impress/new.html.twig', [
            'impress' => $impress,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_impress_show', methods: ['GET'])]
    public function show(Impress $impress): Response
    {
        return $this->render('impress/show.html.twig', [
            'impress' => $impress,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_impress_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Impress $impress, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImpressType::class, $impress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_impress_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('impress/edit.html.twig', [
            'impress' => $impress,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_impress_delete', methods: ['POST'])]
    public function delete(Request $request, Impress $impress, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$impress->getId(), $request->request->get('_token'))) {
            $entityManager->remove($impress);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_impress_index', [], Response::HTTP_SEE_OTHER);
    }
}
