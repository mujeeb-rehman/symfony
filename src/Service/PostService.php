<?php

namespace App\Service;

use App\Entity\Post;
use App\Entity\Author;
use App\Repository\PostRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * class UserService
 * @package App\Service
 * @property PostRepository $postRepository
 */
class PostService
{
    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Post $post
     */
    public function createPost(Post $post)
    {
        $this->postRepository->persist($post, true);
    }

    /**
     * @return Post[]
     */
    public function allPosts(): array
    {
        return $this->postRepository->findAll();
    }

    /**
     * @param Author $author
     * @return array
     */
    public function allPostsByAuthor(Author $author): array
    {
        return $this->postRepository->findBy(['author' => $author]);
    }

    /**
     * @param int $id
     * @return Post|null
     */
    public function singlePost(int $id): ?Post
    {
        return $this->postRepository->find($id);
    }

    /**
     * @param Post $post
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removePost(Post $post)
    {
        $this->postRepository->remove($post);
    }
}