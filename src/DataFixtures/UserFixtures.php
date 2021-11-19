<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $names = array("Waqas Mahmood", "Mujeeb", "Ali", "Bilal");
        $usernames = array("coeus", "admin", "editor", "viewer");
        $password = "password123";

        $roles = array('ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_EDITOR', 'ROLE_VIEWER');
        

        for($i = 0; $i < 4; $i++)
        {
            $user = new User();
            $user->setName($names[$i]);
            $user->setUsername($usernames[$i]);
            $user->setRoles([$roles[$i]]);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
