<?php

namespace App\DataFixtures;

use App\Entity\Keyword;
use App\Entity\User;
use App\Entity\UserPreference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class KeywordFixtures extends Fixture
{
    public const KEYWORD_REFERENCE = 'keyword';

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');

    /* Load all keywords */
        for ($i = 1; $i < 100; $i++) {
            $keyword = new Keyword();
            $keyword->setName($faker->word);
            $keyword->setUri("https://symfony.com");

            $manager->persist($keyword);
            $this->addReference(self::KEYWORD_REFERENCE.$i, $keyword);
        }

        $manager->flush();
    }
}