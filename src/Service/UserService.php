<?php

namespace App\Service;

use App\DTO\CreateUserDTO;
use App\Entity\User;
use App\Repository\UserRepository;

class UserService {

    public function __construct(private UserRepository $userRepository,
                                private RoleService $roleService)
    {
        
    }

    public function createUser(CreateUserDTO $dto): User {
        
        $role = $this->roleService->getRoleByValue(value: "user");

        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword($dto->password);

        $user->addRole($role);

        return $this->userRepository->create($user);
    }

    public function getAllUsers(): array {
        return $this->userRepository->findAll();
    }

}