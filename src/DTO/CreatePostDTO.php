<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreatePostDTO {
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly int $userId,
    )
    {
        
    }
} 