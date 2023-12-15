<?php

namespace App\Controller;

use App\DTO\CreateRoleDTO;
use App\Service\RoleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/roles")]

class RoleController extends AbstractController
{
    public function __construct(private RoleService $roleService)
    {
        
    }

    #[Route("/", name: "createRole", methods: ["POST"])]
    public function createRole(#[MapRequestPayload] CreateRoleDTO $roleDto): JsonResponse
    {
        return $this->json(
            $this->roleService->createRole($roleDto)
        );
    }

    #[Route("/{value}", name: "getRoleByValue", methods: ["GET"])]
    public function getRoleByValue(string $value)
    {
        return $this->json(
            $this->roleService->getRoleByValue($value)
        );
    }
}
