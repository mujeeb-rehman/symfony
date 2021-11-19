<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * class UserService
 * @package App\Service
 * @property UserRepository $userRepository
 * @property UserPasswordEncoderInterface $passwordEncoder
 */
class UserService
{
    /**
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param User $user
     */
    public function createUser(User $user)
    {
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

        $this->userRepository->persist($user, true);
    }

    /**
     * @return User[]
     */
    public function allUsers(): array
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function singleUser(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param User $user
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removeUser(User $user)
    {
        $this->userRepository->remove($user);
    }
}