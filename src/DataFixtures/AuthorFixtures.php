<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = array("hamza", "tayyab", "abdullah");
        $title = "developer";
        $usernames = array("hamza", "tayyab", "abdullah");
        $shortBio = "This is a short bio of the author";
        $phone = "123456789";

        for($i = 0; $i < 3; $i++)
        {
            $author = new Author();

            $author->setName($names[$i]);
            $author->setTitle($title);
            $author->setUsername($usernames[$i]);
            $author->setShortBio($shortBio);
            $author->setPhone($phone);

            $manager->persist($author);
        }
        

        $manager->flush();
    }
}
