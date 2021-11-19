<?php

namespace App\Service;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * class AuthorService
 * @package App\Service
 * @property AuthorRepository $authorRepository
 */
class AuthorService
{
    /**
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param Author $author
     */
    public function createAuthor(Author $author)
    {
        $this->authorRepository->persist($author, true);
    }

    /**
     * @return Author[]
     */
    public function allAuthors(): array
    {
        return $this->authorRepository->findAll();
    }

    /**
     * @param int $id
     * @return Author|null
     */
    public function singleAuthor(int $id): ?Author
    {
        return $this->authorRepository->find($id);
    }

    /**
     * @param Author $author
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removeAuthor(Author $author)
    {
        $this->authorRepository->remove($author);
    }
}