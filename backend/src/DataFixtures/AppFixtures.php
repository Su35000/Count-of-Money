<?php

namespace App\DataFixtures;

use App\Entity\CryptoCurrency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

    }

    public function getDependencies(): array
    {
        return [
            KeywordFixtures::class,
            CryptoCurrencyFixtures::class,
            UserFixtures::class,
            ArticleFixtures::class,
            FluxRssFixtures::class
        ];
    }
}
