<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Role;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Nous gérons les roles
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstName('francis')
                  ->setLastName('Tran')
                  ->setEmail('francis@gmail.com')
                  ->setPassword($this->encoder->encodePassword($adminUser, 'password'))
                  ->setPicture('https://lh3.googleusercontent.com/ogw/ADGmqu-T6FWQ0sP_OPv-rnDiiNhK2JQZB67ye6xMuwpyR2g=s192-c-mo')
                  ->setIntroduction('introduction...')
                  ->setDescription('description...')
                  ->addUserRole($adminRole);
        $manager->persist($adminUser);

        $manager->flush();
    }
}
