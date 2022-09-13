<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Address;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        require_once 'vendor/autoload.php';


        $faker = Factory::create('en_GB');

        for ($i = 0; $i < 50; $i++) {

            $address = (new Address())
                ->setCountryCode($faker->words(1, true))
                ->setCity($faker->city())
                ->setName($faker->name())
                ->setStreet($faker->address())
                ->setAddressAux($faker->address())
                ->setPostalCode($faker->postcode());

            $manager->persist($address);
        }
        $manager->flush();
    }
}
