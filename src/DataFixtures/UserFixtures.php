<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) 
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        // Création d’un utilisateur de type “contributeur” (= auteur)
        $contributor = new User();
        $contributor->setEmail('contributor@monsite.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $contributor->setUsername('Toto');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $contributor,
            'contributorpassword'
        );

        $contributor->setPassword($hashedPassword);
        $manager->persist($contributor);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('ADMIN');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'adminpassword'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        $contributor = new User();
        $contributor->setEmail('tatamo@gmail.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $contributor->setUsername('Tata');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $contributor,
            'tatapassword'
        );
        $contributor->setPassword($hashedPassword);
        $manager->persist($contributor);

        $this->addReference('user_' . $contributor->getEmail(), $contributor);
        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();
    }
}
