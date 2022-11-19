<?php

namespace App\Controller\Back;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/posts')]
class PostsController extends AbstractController
{
    #[Route('/', name: 'app_back_posts_index', methods: ['GET'])]
    public function index(PostsRepository $postsRepository): Response
    {
        return $this->render('back/posts/index.html.twig', [
            'posts' => $postsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_posts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostsRepository $postsRepository): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postsRepository->save($post, true);

            return $this->redirectToRoute('app_back_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/posts/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_posts_show', methods: ['GET'])]
    public function show(Posts $post): Response
    {
        return $this->render('back/posts/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_posts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Posts $post, PostsRepository $postsRepository): Response
    {
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postsRepository->save($post, true);

            return $this->redirectToRoute('app_back_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/posts/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_posts_delete', methods: ['POST'])]
    public function delete(Request $request, Posts $post, PostsRepository $postsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postsRepository->remove($post, true);
        }

        return $this->redirectToRoute('app_back_posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
