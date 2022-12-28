<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class SecurityController extends AbstractController
{

    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    // #[Route('/api/contact_check', methods: ['GET'])]
    // public function createRoute(Request $request)
    // {   
        // Récupère l'adresse email de la requête
        // $data = json_decode($request->getContent(), true);
        // $email = $data['auth'] ?? null;
        #$password = $data['password'];
        // $request = Request::createFromGlobals();
        // $cookies = $request->cookies;
        // Génère un nouveau token JWT avec les informations de l'utilisateur
        // $jwt = $this->jwtEncoder->encode([
        //     'username' => 'contact' ,
        //     'roles' => ['ROLE_CONTACT'],
        // ]);

        // Vérifie si l'adresse email est valide
        // if ($email !== true) {
        //     // Renvoie une réponse d'erreur si l'adresse email est invalide
        //     return new Response('Vous n\'avez pas les droits', 403);
        // };
        // $request->cookies->set('BEARER', $jwt);
        #dd($request);
        // Crée un nouvel objet de réponse
        // $response = new Response();
        // // Définissez les en-têtes de la réponse
        // $response->headers->set('Content-Type', 'application/json');
        // $response->headers->set('Access-Control-Allow-Origin', '*');
        // $response->headers->setcookie(new Cookie('BEARER', $jwt));
        // $response->send();
        // // Définissez le contenu de la réponse
        // $response->setContent(json_encode([
        //     'message' => 'Success',
        //     $response->send(),
        // ]));
        // Définissez ici les options de sécurité pour les cookies
        // $cookieOptions = [
        //     "name" => "BEARER",
        //     "expires" => time() + 3600, // Expire dans une heure
        //     "path" => "/", // Disponible sur tout le site
        //     "domain" => "localhost", // Disponible sur votre domaine
        //     "secure" => true, // Seulement sur HTTPS
        //     "httponly" => true, // Inaccessible en JavaScript
        // ];

        // // Définissez ici les valeurs du cookie
        // $cookieValues = [
        //     "value" => $jwt,
        //     "expires" => time() + 3600, // Expire dans une heure
        //     "path" => "/", // Disponible sur tout le site
        //     "domain" => "localhost", // Disponible sur votre domaine
        //     "secure" => true, // Seulement sur HTTPS
        //     "httponly" => true, // Inaccessible en JavaScript
        // ];

        // Envoyez ici le cookie au navigateur

            #dd($name);
            
            
    //         return $response;
        
    // }



    // #[Route(path: '/api/contact_check', name: 'api_token', methods: ['POST'])]
    // public function login(AuthenticationUtils $authenticationUtils, Request $request, UserProviderInterface $userProvider): Response
    // {
    //     $data = json_decode($request->getContent(), true);

    //     $email = $data['email'];
    //     $password = $data['password'];

    //     $passport = new SelfValidatingPassport(new UserBadge($email), []);
    //     dd($passport);

    //     // if ($this->getUser()) {
    //     //     return $this->redirectToRoute('target_path');
    //     // }

    //     // get the login error if there is one
    //     #$error = $authenticationUtils->getLastAuthenticationError();
    //     // last username entered by the user
    //     #$lastUsername = $authenticationUtils->getLastUsername();

    //     return $this->json(
    //                 $user,
    //                 200,
    //                 []
    //     );
    // }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

}
   