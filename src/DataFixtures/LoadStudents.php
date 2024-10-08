<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class LoadStudents extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $numStudents = 10;
        for ($i=0; $i < $numStudents; $i++) {
            $firstName = $faker->firstNameMale;
            $surname = $faker->lastName;
            $student = new Student();
            $student->setFirstName($firstName);
            $student->setSurname($surname);
            $manager->persist($student);
        }
        $manager->flush();
    }
}
