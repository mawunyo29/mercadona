<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    private  $passwordEncoder;
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordEncoder = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new Admin();
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail('admin@mercadona.fr');

        // Hachage du mot de passe
        $hashedPassword = $this->passwordEncoder->hashPassword($user, 'admin');
        $user->setPassword($hashedPassword);

        // Persistez l'utilisateur en base de données
        $manager->persist($user);
        $manager->flush();


        $manager->flush();
    }
}
