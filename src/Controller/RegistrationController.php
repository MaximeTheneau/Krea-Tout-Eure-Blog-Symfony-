<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\Contact;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class RegistrationController extends AbstractController
{
    private $jwtManager;

    public function __construct(
        JWTTokenManagerInterface $jwtManager,
    )
    {
        $this->jwtManager = $jwtManager;
    }
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_back_home');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/api/register', name: 'api_register')]
    public function registerApi(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = new Contact();
        $user->setUsername($data['username']);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $data['password']
            )
        );
        $token = 'Bearer'.$this->jwtManager->create($user);
        $userData = [
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ];

        $tokenStorageContainer = new TokenStorage();

        dd($tokenStorageContainer->set(setToken::class, $token));
        $response = new Response();
        $response->headers->set('Authorization', );
        $response->setContent(json_encode([
                    'message' => 'Account created successfully'
                ]));
        $response->setStatusCode(Response::HTTP_CREATED);

        return $response;
    }
}
