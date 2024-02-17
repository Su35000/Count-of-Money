<?php

namespace App\DataFixtures;

use App\Entity\CryptoCurrency;
use App\Entity\Keyword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CryptoCurrencyFixtures extends Fixture
{
    public const CRYPTOCURRENCY_REFERENCE = 'cryptoCurrency';


    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');
        $cryptoCurrenciesNames = ["Bitcoin", "Ethereum", "Tether", " USD Coin", "BNB", "Binance Coin USD", "XRP", "Cardano", "Solana", "Dogecoin"];

    /* Load all keywords */
        for ($i = 1; $i < 10; $i++) {
            $cryptoCurrency = new CryptoCurrency();
            $cryptoCurrency->setName($cryptoCurrenciesNames[$i-1]);
            $cryptoCurrency->setCurrentPrice(strval($faker->randomFloat(1, 5000, 99999)));
            $cryptoCurrency->setHighestPriceDay(strval($faker->randomFloat(1, 5000, 99999)));
            $cryptoCurrency->setLowestPriceDay(strval($faker->randomFloat(1, 5000, 99999)));
            $cryptoCurrency->setOpeningPrice(strval($faker->randomFloat(1, 5000, 99999)));

            $manager->persist($cryptoCurrency);
            $this->addReference(self::CRYPTOCURRENCY_REFERENCE.$i, $cryptoCurrency);
        }

        $manager->flush();
    }
}