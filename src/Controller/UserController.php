<?php

namespace App\Controller;

use App\DTO\CreateUserDTO;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    public function __construct(private UserService $userService)
    {
        
    }

    #[Route("/users", name: "createUser", methods: ["POST"])]
    public function createUser(#[MapRequestPayload] CreateUserDTO $userDto): JsonResponse
    {
        return $this->json(
            $this->userService->createUser($userDto)
        );
    }

    #[Route("/users", name: "getAllUsers", methods: ["GET"])]
    public function getAllUsers()
    {
        return $this->json(
            $this->userService->getAllUsers()
        );
    }
}
