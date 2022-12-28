<?php

namespace App\Controller\Api;

use App\Entity\Posts;
use App\Repository\PostsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * @Route("/api/posts",name="api_posts_")
 */
class PostsController extends ApiController
{


    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(PostsRepository $postsRepository ): JsonResponse
    {
    
        $allPosts = $postsRepository->findLastPosts();

        return $this->json(
            $allPosts,
            Response::HTTP_OK,
            [],
            [
                "groups" => 
                [
                    "api_posts_browse"
                ]
            ]
        );
    }

    /**
     * @Route("/thumbnail", name="thumbnail", methods={"GET"})
     */
    public function thumbnail(PostsRepository $postsRepository ): JsonResponse
    {
    
        $allPosts = $postsRepository->findLastPosts();
        #dd($allPages);

        return $this->json(
            $allPosts,
            Response::HTTP_OK,
            [],
            [
                "groups" => 
                [
                    "api_posts_thumbnail"
                ]
            ]
        );
    }

    /**
     * @Route("/{slug}", name="read", methods={"GET"})
     */
    public function read(Posts $posts = null)
    {
        if ($posts === null)
        {
            // on renvoie donc une 404
            return $this->json(
                [
                    "erreur" => "Page non trouvée",
                    "code_error" => 404
                ],
                Response::HTTP_NOT_FOUND,// 404
            );
        }

        return $this->json(
            $posts,
            // code HTTP pour dire que tout se passe bien (200) 
            Response::HTTP_OK,
            // les entêtes HTTP, on les utilise dans très peu de cas, donc valeur par défaut : []
            [],
            // le contexte, on l'utilise pour spécifier les groupes de serialisation
            [
                // je lui donne le/les noms de groupes de serialisation
                "groups" => 
                [
                    "api_posts_read"
                ]
            ]);
    }

   

}
