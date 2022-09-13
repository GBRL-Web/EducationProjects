<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $size = (new Size())
            ->setName('XL');

        $manager->persist($size);

        $manager->flush();
    }
}
