<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\CommentRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * class CommentService
 * @package App\Service
 * @property CommentRepository $commentRepository
 */
class CommentService
{
    /**
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param Comment $comment
     */
    public function createComment(Comment $comment)
    {
        $this->commentRepository->persist($comment, true);
    }

    /**
     * @return Comment[]
     */
    public function allComments(): array
    {
        return $this->commentRepository->findAll();
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function allCommentsByPost(Post $post)
    {
        return $this->commentRepository->findAllByPost($post);
    }

    /**
     * @param int $id
     * @return Comment|null
     */
    public function singleComment(int $id): ?Comment
    {
        return $this->commentRepository->find($id);
    }

    /**
     * @param Comment $comment
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removeComment(Comment $comment)
    {
        $this->commentRepository->remove($comment);
    }
}