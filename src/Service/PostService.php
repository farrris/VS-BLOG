<?php

namespace App\Service;

use App\DTO\CreatePostDTO;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class PostService
{
    public function __construct(private PostRepository $postRepository,
                                private EntityManagerInterface $entityManager,
                                private FileService $fileService)
    {
        
    }

    public function getAllPosts()
    {
        return $this->postRepository->findAll();
    }

    public function createPost(CreatePostDTO $postDto, $image): Post
    {   
        $post = new Post();

        $post->setTitle($postDto->title);
        $post->setContent($postDto->content);
        if ($image) $post->setImage($this->fileService->createFile($image));
        $post->setAuthor($this->entityManager->getReference(User::class, $postDto->userId));

        return $this->postRepository->save($post);
    }
}