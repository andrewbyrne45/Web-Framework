<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    private $passwordEncoder1;
    private $passwordEncoder2;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('andrew@byrne.com');
        $user->setRoles(['ROLE_USER', 'ROLE_USER']);

        $user1 = new User();
        $user1->setEmail('joe@bloggs.com');
        $user1->setRoles(['ROLE_HEAD', 'ROLE_HEAD']);

        $user2 = new User();
        $user2->setEmail('matt@smith.com');
        $user2->setRoles(['ROLE_ADMIN', 'ROLE_ADMIN']);

        $plainPassword = 'user';
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);

        $plainPassword1 = 'head';
        $encodedPassword1 = $this->passwordEncoder->encodePassword($user1, $plainPassword1);

        $plainPassword2 = 'admin';
        $encodedPassword2 = $this->passwordEncoder->encodePassword($user2, $plainPassword2);

        $user->setPassword($encodedPassword);
        $user1->setPassword($encodedPassword1);
        $user2->setPassword($encodedPassword2);

        $manager->persist($user);
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();
    }
}