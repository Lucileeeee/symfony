<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $tabAuthor = [];
        for ($i = 0; $i < 50; $i ++) {
            $account = new Account();
            $account->setFirstname($faker->firstname())
                    ->setLastname($faker->lastname())
                    ->setEmail($faker->unique()->email())
                    ->setPassword($faker->password())
                    ->setRoles('ROLE_USER');
            $manager->persist($account);
            $tabAuthor[] = $account;
        }
        $tabCat = [];
        for ($i = 0; $i < 30; $i ++) {
            $cat = new Category();
            $cat->setName($faker->word());
          /*   $cat->setName($faker->unique()->jobTitle()); */
            $manager->persist($cat);
            $tabCat[] = $cat;
        }

        for ($i = 0; $i < 100; $i ++){
            $article = new Article();
            $article->setTitle($faker->sentence(3))
                    ->setcontent($faker->realText(300, 2))
                    ->setCreateAt(new \DateTimeImmutable($faker->date()))
                    ->setAuthor($faker->randomElement($tabAuthor))
                    ->addCategory($tabCat[$faker->numberBetween(0,9)])
                    ->addCategory($tabCat[$faker->numberBetween(10,18)])
                    ->addCategory($tabCat[$faker->numberBetween(19,29)]);
            $manager->persist($article);
        }
        $manager->flush();
    }
}

