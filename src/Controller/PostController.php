<?php

namespace App\Controller;

use App\DTO\CreatePostDTO;
use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/posts")]
class PostController extends AbstractController
{   

    public function __construct(private PostService $postService)
    {
        
    }

    #[Route('/', name: 'getAllPosts', methods: ["GET"])]
    public function getAllPosts(): JsonResponse
    {
        return $this->json(
            $this->postService->getAllPosts()
        );
    }

    #[Route('/', name: 'createPost', methods: ["POST"])]
    public function createPost(Request $request, #[MapRequestPayload()] CreatePostDTO $postDTO): JsonResponse
    {
        return $this->json([
            $this->postService->createPost($postDTO, $request->files->get("image"))
        ]);
    }
}
