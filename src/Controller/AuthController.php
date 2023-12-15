<?php

namespace App\Controller;

use App\DTO\CreateUserDTO;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/auth")]
class AuthController extends AbstractController
{   
    public function __construct(private AuthService $authService)
    {
        
    }

    #[Route("/registration", name: "registration", methods: ["POST"])]
    public function registration(#[MapRequestPayload] CreateUserDTO $userDto): JsonResponse
    {
        return $this->json(
            $this->authService->registration($userDto)
        );
    }

    #[Route("/login", name: "login", methods: ["POST"])]
    public function login(#[MapRequestPayload] CreateUserDTO $userDto): JsonResponse
    {
        return $this->json(
            $this->authService->login($userDto)
        );
    }
}
