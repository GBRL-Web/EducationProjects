<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Message;

class MessageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        $faker = Factory::create('fr_FR');


        for ($i = 0; $i < 10; $i++) {
            $message = (new Message())
                ->setName($faker->name($gender = 'male' || 'female'))
                ->setEmail($faker->email())
                ->setMessage($faker->realText(200, 2));

            $manager->persist($message);
        }
        // $manager->persist($product);

        $manager->flush();
    }
}
