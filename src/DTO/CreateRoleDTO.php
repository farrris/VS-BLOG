<?php

namespace App\DTO;

class CreateRoleDTO {
    public function __construct(
        public readonly string $value,
        public readonly string $description
    )
    {
        
    }
} 