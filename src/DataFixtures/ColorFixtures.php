<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Color;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ColorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        require_once 'vendor/autoload.php';

        $faker = Factory::create('fr_FR');


        for ($i = 0; $i < 10; $i++) {
            $color = (new Color())
                ->setName($faker->unique()->safeColorName());

            $manager->persist($color);
        }


        $manager->flush();
    }
}
