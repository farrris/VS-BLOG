<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Uid\Uuid;

class FileService
{
    public function createFile(UploadedFile $file): string
    {
        try {
            $filename = Uuid::v4() . ".jpg";
            $filepath = "uploads/";
            if (!is_dir($filepath)) {
                mkdir($filepath);
            }
            $file->move($filepath, $filename);
            return $filename;
         } catch (Exception) {
             throw new HttpException(message: "Произошла ошибка при записи файла", statusCode: Response::HTTP_INTERNAL_SERVER_ERROR);
         }
    }
}