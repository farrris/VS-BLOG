<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if ($user->getBanned()) {
            throw new HttpException(message: "You're banned !", statusCode: Response::HTTP_FORBIDDEN);
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {}
}