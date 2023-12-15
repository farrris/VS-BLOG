<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDTO {
    public function __construct(
        #[Assert\NotBlank(message: "Заполните email")]
        #[Assert\Email(message: "Dведенное значение не является email")]
        public readonly string $email,
        #[Assert\NotBlank(message: "Заполните пароль")]
        #[Assert\Length(min: 4, minMessage: "Пароль должен содержать минимум 4 символа")]
        public readonly string $password
    )
    {
        
    }
}