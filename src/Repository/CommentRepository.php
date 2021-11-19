<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

     /**
      * @return Comment[] Returns an array of Comment objects
      */
    public function findAllByPost(Post $post): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.post = :val')
            ->setParameter('val', $post)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param Post $post
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function removeSomeByPost(Post $post)
    {
        return $this->createQueryBuilder('c')
            ->where('c.post =  :val')
            ->setParameter('val', $post)
            ->delete();
    }


    /*
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
