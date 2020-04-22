<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        // (1) create object
        $user = new User();
        $user->setEmail('andrew@byrne.com');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_TEACHER']);

        $plainPassword = 'admin';
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);

        $user->setPassword($encodedPassword);
        //(2) queue up object to be inserted into DB

        $manager->persist($user);

        // (3) insert objects into database
        $manager->flush();
    }
}
