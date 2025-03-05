<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $tabAuthor = array();
        for ($i = 0; $i < 50; $i ++) {
            $account = new Account();
            $account->setFirstname($faker->firstname())
                    ->setLastname($faker->lastname())
                    ->setEmail($faker->email())
                    ->setPassword($faker->password())
                    ->setRoles('ROLE_USER');
            $manager->persist($account);
            $tabAuthor[] = $account;
        }
        for ($i = 0; $i < 100; $i ++){
            $article = new Article();
            $article->setTitle($faker->sentence(5))
                    ->setcontent($faker->text(300))
                    ->setCreateAt(new \DateTimeImmutable($faker->date()))
                    ->setAuthor($faker->randomElement($tabAuthor));
            $manager->persist($article);
        }
        $manager->flush();
    }
}

