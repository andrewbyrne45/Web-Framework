<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Group;

class GroupFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cat1 = new Group();
        $cat1->setName('Computer Science - Year 3');

        $cat2 = new Group();
        $cat2->setName('Business - Year 1');

        $cat3 = new Group();
        $cat3->setName('Digital Media - Year 4');

        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);


        $manager->flush();
    }
}