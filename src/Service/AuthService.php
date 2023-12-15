<?php

namespace App\Service;

use App\DTO\CreateUserDTO;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class AuthService 
{   

    private PasswordHasherInterface $passwordEncoder;

    public function __construct(private UserService $userService,
                                private UserPasswordHasherInterface $passwordHasher,
                                private PasswordHasherFactoryInterface $hasherFactory,
                                private JWTTokenManagerInterface $JWTManager)
    {   
        $this->setPasswordEncoder();
    }

    private function setPasswordEncoder()
    {
        $this->passwordEncoder = $this->hasherFactory->getPasswordHasher(User::class);
    }

    private function generateToken(User $user)
    {   
        return [ 
            "token" => $this->JWTManager->createFromPayload(user: $user, payload: ["id" => $user->getId()])
        ];
    }

    public function registration(CreateUserDTO $userDto) 
    {
        $candidate = $this->userService->getUserByEmail($userDto->email);
        if ($candidate) {
            throw new HttpException(message: "Пользователь с таким email уже существует", statusCode: Response::HTTP_BAD_REQUEST);
        }

        $hashedPassword = $this->passwordEncoder->hash($userDto->password);

        $user = $this->userService->createUser(new CreateUserDTO(email: $userDto->email, password: $hashedPassword));

        return $this->generateToken($user);
    }

    public function login(CreateUserDTO $userDto)
    {
        $user = $this->validateUser($userDto);
        return $this->generateToken($user);
    }

    private function validateUser(CreateUserDTO $userDto)
    {
        $user = $this->userService->getUserByEmail($userDto->email);

        if ($user && $this->passwordEncoder->verify($user->getPassword(), $userDto->password))
        {
            return $user;
        }

        throw new HttpException(message: "Неправильный email или пароль", statusCode: Response::HTTP_UNAUTHORIZED);
    }
}