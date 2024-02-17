<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\CryptoCurrency;
use App\Entity\Keyword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');

    /* Load all Articles */
        for ($i = 1; $i < 10; $i++) {
            $article = new Article();
            $article->setDate(new \DateTime('now'));
            $article->setSource($faker->word);
            $article->setTitle($faker->word);
            $article->setSummary($faker->word);
            $article->setUrlImage($faker->word);
            $article->setUrlPage($faker->word);
            $article->setUser($this->getReference('user' . $i));
/*
            $article->setSource($faker->sentence . ".com");
            $article->setTitle($faker->word);
            $article->setSummary($faker->sentence);
            $article->setUrlImage("images/");
            $article->setUrlPage("$faker->url");
*/
            $manager->persist($article);
        }

        $manager->flush();
    }
}