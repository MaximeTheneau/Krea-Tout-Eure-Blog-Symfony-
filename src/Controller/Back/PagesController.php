<?php

namespace App\Controller\Back;

use App\Entity\Pages;
use App\Form\PagesType;
use App\Repository\PagesRepository;
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

#[Route('/pages')]
class PagesController extends AbstractController
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

    #[Route('/', name: 'app_back_pages_index', methods: ['GET'])]
    public function index(PagesRepository $pagesRepository): Response
    {        

        return $this->render('back/pages/index.html.twig', [
            'pages' => $pagesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_pages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PagesRepository $pagesRepository): Response
    {
        $page = new Pages();
        $form = $this->createForm(PagesType::class, $page);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $slugImg = $this->projectDir.$this->photoDir.$this->slugger->slug($this->slugger->slug($page->getTitle())).'-500-100.webp';
            
            $this->imageOptimizer->setPicture($form->get('imgHeader')->getData(), $this->slugger->slug($page->getTitle()));

            $page->setSlug($this->slugger->slug($page->getTitle()));
            $page->setImgHeader($slugImg);
            $pagesRepository->save($page, true);
            
            return $this->redirectToRoute('app_back_pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/pages/new.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_pages_show', methods: ['GET'])]
    public function show(Pages $page): Response
    {
        $page->getImgHeader();


        return $this->render('back/pages/show.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_pages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pages $page, PagesRepository $pagesRepository): Response
    {
        $imgHeader= $page->getImgHeader();
        $page = new Pages();
        $page->setImgHeader($imgHeader);
        $form = $this->createForm(PagesType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $pagesRepository->save($page, true);


            return $this->redirectToRoute('app_back_pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/pages/edit.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_pages_delete', methods: ['POST'])]
    public function delete(Request $request, Pages $page, PagesRepository $pagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $pagesRepository->remove($page, true);
        }

        return $this->redirectToRoute('app_back_pages_index', [], Response::HTTP_SEE_OTHER);
    }
}
