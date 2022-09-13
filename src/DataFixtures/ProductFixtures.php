<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        require_once 'vendor/autoload.php';

        $faker = Factory::create('fr_FR');


        for ($i = 0; $i < 50; $i++) {
            $product = (new Product())
                ->setName($faker->company())
                ->setTag($faker->words(1, true))
                ->setDescription($faker->realText(200, 2))
                ->setWeight($faker->randomFloat(0.1, 5))
                ->setMaterial($faker->words(1, true))
                ->setBrand('Braka')
                ->setQuantity($faker->numberBetween(1, 50))
                ->setPrice($faker->numberBetween(5, 100))
                ->setImglink($faker->imageUrl(640, 480, '', true));
            $manager->persist($product);
        }


        $manager->flush();
    }
}
