<?php

namespace App\Service;

use App\DTO\AddRoleToUserDTO;
use App\DTO\BanUserDTO;
use App\DTO\CreateUserDTO;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService {

    public function __construct(private UserRepository $userRepository,
                                private RoleService $roleService)
    {
        
    }

    public function createUser(CreateUserDTO $dto): User {
        
        $role = $this->roleService->getRoleByValue(value: "ROLE_USER");

        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword($dto->password);

        $user->setRoles($role);

        return $this->userRepository->save($user);
    }

    public function getAllUsers(): array {
        return $this->userRepository->findAll();
    }

    public function getUserByEmail(string $email): User|null {
        return $this->userRepository->findByEmail($email);
    }

    public function addRoleToUser(AddRoleToUserDTO $addRoleToUserDTO) {
        $user = $this->userRepository->findById($addRoleToUserDTO->userId);
        $role = $this->roleService->getRoleByValue($addRoleToUserDTO->roleValue);
        if ($user && $role) {
            $user->setRoles($role);
            $this->userRepository->save($user);
            return $addRoleToUserDTO;
        }

        throw new HttpException(message: "Пользователь или роль не найдены", statusCode: Response::HTTP_NOT_FOUND);
    }

    public function banUser(BanUserDTO $banUserDTO) {
        $user = $this->userRepository->findById($banUserDTO->userId);
        if (!$user) throw new HttpException(message: "Пользователь не найден", statusCode: Response::HTTP_NOT_FOUND);
        $user->setBanned(true);
        $user->setBanReason($banUserDTO->banReason);
        return $this->userRepository->save($user);
    }

}