<?php

namespace App\Controller;

use App\DTO\AddRoleToUserDTO;
use App\DTO\BanUserDTO;
use App\DTO\CreateUserDTO;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route("admin/users")]
class UserController extends AbstractController
{

    public function __construct(private UserService $userService)
    {
        
    }

    #[Route("/", name: "createUser", methods: ["POST"])]
    public function createUser(#[MapRequestPayload] CreateUserDTO $userDto): JsonResponse
    {
        return $this->json(
            $this->userService->createUser($userDto)
        );
    }

    #[Route("/", name: "getAllUsers", methods: ["GET"])]
    public function getAllUsers()
    {
        return $this->json(
            $this->userService->getAllUsers()
        );
    }

    #[Route("/role", name: "addRoleToUser", methods: ["POST"])]
    public function addRoleToUser(#[MapRequestPayload] AddRoleToUserDTO $addRoleToUserDTO)
    {
        return $this->json(
            $this->userService->addRoleToUser($addRoleToUserDTO)
        );
    }

    #[Route("/ban", name: "banUser", methods: ["POST"])]
    public function banUser(#[MapRequestPayload] BanUserDTO $banUserDTO)
    {
        return $this->json(
            $this->userService->banUser($banUserDTO)
        );
    }
}
