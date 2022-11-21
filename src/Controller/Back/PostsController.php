<?php

namespace App\Controller\Back;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use App\Services\ImageOptimizer;

#[Route('/posts')]
class PostsController extends AbstractController
{
    private $imageOptimizer;
    private $slugger;
    private $photoDir;
    private $params;
    private $projectDir;

    public function __construct(
        ContainerBagInterface $params,
        ImageOptimizer $imageOptimizer,
        SluggerInterface $slugger,
    )
    {
        $this->params = $params;
        $this->imageOptimizer = $imageOptimizer;
        $this->slugger = $slugger;
        $this->projectDir =  $this->params->get('app.projectDir');
        $this->photoDir =  $this->params->get('app.imgDir');
    }

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
            $slug = $this->slugger->slug($post->getTitle());
            $post->setSlug($slug);


            // IMAGE 1
            $this->imageOptimizer->setPicture($form->get('imgPost')->getData(), $post, 'setImgPost', 'imgPost');
            $this->imageOptimizer->setThumbnail($form->get('imgPost')->getData(), $post, 'setImgPost', 'imgPost');


            // IMAGE 2
            $this->imageOptimizer->setPicture($form->get('imgPost2')->getData(), $post, 'setImgPost2', 'imgPost-2');

            // IMAGE 3
            $this->imageOptimizer->setPicture($form->get('imgPost3')->getData(), $post, 'setImgPost3', 'imgPost-3');

            // IMAGE 4
            $this->imageOptimizer->setPicture($form->get('imgPost4')->getData(), $post, 'setImgPost4', 'imgPost-4');

           

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
        $img = json_decode($post->getImgPost(), true);
        $img2 = json_decode($post->getImgPost2(), true);
        $img3 = json_decode($post->getImgPost3(), true);
        $img4 = json_decode($post->getImgPost4(), true);

        return $this->render('back/posts/show.html.twig', [
            'post' => $post,
            'img' => $img,
            'img2' => $img2,
            'img3' => $img3,
            'img4' => $img4,
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
