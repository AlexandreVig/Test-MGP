<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/api/auth', name: 'api_auth_')]
class AuthController extends AbstractController
{
    #[Route('/register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, UserRepository $userRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate email and password presence
        if (!isset($data['email'], $data['password'])) {
            return $this->json(['error' => 'Email and password are required'], 400);
        }

        // Check if the email is already in use
        if ($userRepository->findOneBy(['email' => $data['email']])) {
            return $this->json(['error' => 'Email is already in use'], 400);
        }

        // Create new user
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['message' => 'User registered'], 201);
    }

    #[Route('/me', methods: ['GET'])]
    public function me(UserInterface $user): JsonResponse
    {
        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
        ], 200);
    }
}
