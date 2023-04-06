<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = ['The earth is flat', 'One hundred angels can dance on the head of a pin', 'The earth is flat and rests on a bull\'s horn', 'The earth is like a ball.'];

        foreach ($data as $i => $content) {
            $post = new Post();
            $post
                ->setTitle('Titre '.($i+1))
                ->setContent($content);

            $manager->persist($post);
        }
        $manager->flush();
    }
}
