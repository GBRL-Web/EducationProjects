<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        require_once 'vendor/autoload.php';


        $faker = Factory::create('en_GB');

        for ($i = 0; $i < 50; $i++) {

            $category = (new Category())

                ->setName($faker->words(1, true));


            $manager->persist($category);
        }
        $manager->flush();
    }
}
