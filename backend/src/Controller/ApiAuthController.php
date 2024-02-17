<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/api')]
class ApiAuthController extends AbstractController
{
    #[Route('/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();

        $user->setEmail($data['email']);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $data['password']
            )
        );

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            "message" => "User have been created",
            "email" => $user->getEmail()
        ], Response::HTTP_CREATED);
    }

    #[Route('/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(): Response
    {
        return $this->json([
            'message' => 'Logout successfully',
        ], Response::HTTP_OK);
    }

    #[Route('/users/me', name: 'api_user_me', methods: ['GET'], priority: 10)]
    public function me(): Response
    {
        $user = $this->getUser();
        $articles = $user->getArticles();
        $cryptoCurrencies = $user->getCryptoCurrency();

        return $this->json([
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "roles" => $user->getRoles(),
            "articles" => $articles,
            "cryptoCurrencies" => $cryptoCurrencies
        ], Response::HTTP_OK);
    }

}
