<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\RoleFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;


class UserFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {

        require_once 'vendor/autoload.php';

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $user = (new User())
                ->setName($faker->firstNameMale())
                ->setUsername($faker->lastName())
                ->setEmail($faker->email())
                ->setTelephone($faker->phoneNumber())
                ->setBirthDate(new DateTime($faker->date()))
                ->setPassword("11aaAA**")
                ->setIdRole($this->getReference(RoleFixtures::ROLE_REFERENCE))
                ->setIsActive(1);
            $manager->persist($user);
        }


        $manager->flush();
    }
}
