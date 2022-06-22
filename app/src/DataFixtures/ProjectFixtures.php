<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Project;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProjectFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $passwordEncoder, SluggerInterface $slugger)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user = new User;
        $user->setName("Admin")
            ->setEmail("admin@test.fr")
            ->setPassword($this->passwordEncoder->hashPassword($user, 'password'));
        $manager->persist($user);

        $category = new Category;
        $category->setName("php");
        $manager->persist($category);

        for ($i = 0; $i <= 10; $i++) {
            $projects = new Project;
            $projects->setName($faker->sentence($nbWords = 2, $variableNbWords = true))
                ->setSlug($this->slugger->slug($projects->getName())->lower())
                ->setContent($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setFile($faker->imageUrl(640, 480))
                ->setLink('https://google.com')
                ->addCategory($category)
                ->setUser($user);
            $manager->persist($projects);
        }

        $manager->flush();
    }
}
