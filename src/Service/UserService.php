<?php

namespace App\Service;

use App\DTO\CreateUserDTO;
use App\Entity\User;
use App\Repository\UserRepository;

class UserService {

    public function __construct(private UserRepository $userRepository)
    {
        
    }

    public function createUser(CreateUserDTO $dto): User {
        
        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword($dto->password);

        $user = $this->userRepository->create($user);

        return $user;
    }

    public function getAllUsers(): array {
        $users = $this->userRepository->findAll();

        return $users;
    }

}