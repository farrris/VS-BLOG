<?php

namespace App\DTO;

class BanUserDTO {
    public function __construct(
        public readonly int $userId,
        public readonly string $banReason
    )
    {
        
    }
} 