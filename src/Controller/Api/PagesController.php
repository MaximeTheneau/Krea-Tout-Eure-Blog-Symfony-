<?php

namespace App\Controller\Api;

use App\Entity\Pages;
use App\Repository\PagesRepository;
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
 * @Route("/api/pages",name="api_pages_")
 */
class PagesController extends ApiController
{


    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(PagesRepository $pagesRepository ): JsonResponse
    {
    
        $allPages = $pagesRepository->findAll();
        #dd($allPages);

        return $this->json(
            $allPages,
            Response::HTTP_OK,
            [],
            [
                "groups" => 
                [
                    "api_pages_browse"
                ]
            ]
        );
    }
    /**
     * @Route("/{slug}", name="read", methods={"GET"})
     */
    public function read(Pages $pages = null)
    {
        if ($pages === null)
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
            $pages,
            // code HTTP pour dire que tout se passe bien (200) 
            Response::HTTP_OK,
            // les entêtes HTTP, on les utilise dans très peu de cas, donc valeur par défaut : []
            [],
            // le contexte, on l'utilise pour spécifier les groupes de serialisation
            [
                // je lui donne le/les noms de groupes de serialisation
                "groups" => 
                [
                    "api_pages_read"
                ]
            ]);
    }

   

}
