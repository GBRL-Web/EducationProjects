<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RoleFixtures extends Fixture
{
    public const ROLE_REFERENCE = 'ROLE_USER';

    public function load(ObjectManager $manager): void
    {

        $user = (new Role())
            ->setIdRole(3)
            ->setName('ROLE_USER');

        $admin = (new Role())
            ->setIdRole(1)
            ->setName('ROLE_ADMIN');

        $commercial = (new Role())
            ->setIdRole(2)
            ->setName('ROLE_COMMERCIAL');


        $manager->persist($user);
        $manager->persist($commercial);
        $manager->persist($admin);

        $manager->flush();

        $this->addReference(self::ROLE_REFERENCE, $user);
    }
}
