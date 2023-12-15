<?php

namespace App\DTO;

class AddRoleToUserDto {
    public function __construct(
        public readonly string $roleValue,
        public readonly int $userId
    )
    {
        
    }
} 