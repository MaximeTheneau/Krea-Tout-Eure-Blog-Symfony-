<?php

namespace App\Controller\Back;

use App\Entity\ImagePlaceholder;
use App\Form\ImagePlaceholderType;
use App\Repository\ImagePlaceholderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/image/placeholder')]
class ImagePlaceholderController extends AbstractController
{
    #[Route('/', name: 'app_back_image_placeholder_index', methods: ['GET'])]
    public function index(ImagePlaceholderRepository $imagePlaceholderRepository): Response
    {
        return $this->render('back/image_placeholder/index.html.twig', [
            'image_placeholders' => $imagePlaceholderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_image_placeholder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImagePlaceholderRepository $imagePlaceholderRepository): Response
    {
        $imagePlaceholder = new ImagePlaceholder();
        $form = $this->createForm(ImagePlaceholderType::class, $imagePlaceholder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagePlaceholderRepository->save($imagePlaceholder, true);

            return $this->redirectToRoute('app_back_image_placeholder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/image_placeholder/new.html.twig', [
            'image_placeholder' => $imagePlaceholder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_image_placeholder_show', methods: ['GET'])]
    public function show(ImagePlaceholder $imagePlaceholder): Response
    {
        return $this->render('back/image_placeholder/show.html.twig', [
            'image_placeholder' => $imagePlaceholder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_image_placeholder_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImagePlaceholder $imagePlaceholder, ImagePlaceholderRepository $imagePlaceholderRepository): Response
    {
        $form = $this->createForm(ImagePlaceholderType::class, $imagePlaceholder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagePlaceholderRepository->save($imagePlaceholder, true);

            return $this->redirectToRoute('app_back_image_placeholder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/image_placeholder/edit.html.twig', [
            'image_placeholder' => $imagePlaceholder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_image_placeholder_delete', methods: ['POST'])]
    public function delete(Request $request, ImagePlaceholder $imagePlaceholder, ImagePlaceholderRepository $imagePlaceholderRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imagePlaceholder->getId(), $request->request->get('_token'))) {
            $imagePlaceholderRepository->remove($imagePlaceholder, true);
        }

        return $this->redirectToRoute('app_back_image_placeholder_index', [], Response::HTTP_SEE_OTHER);
    }
}
