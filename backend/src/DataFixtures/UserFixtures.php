<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserPreference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    public const ADMIN_USER_REFERENCE = 'admin-user';
    public const USER_REFERENCE_JOHN_DOE = 'doe-user';
    public const USER_REFERENCE = 'user';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        $currencies = ["USD", "EUR", "JPY", "GBP", "AUD", "CAD", "CHF", "CNH", "SEK", "NZD"];

    /* Load the ADMIN user */
        $userAdmin = new User();
        $userAdmin->setEmail("admin@admin.com");
        $userAdmin->setPassword($this->hasher->hashPassword($userAdmin,"admin"));
        $userAdmin->setRoles(["ROLE_ADMIN"]);

        $userAdminPreference = new UserPreference();
        $userAdminPreference->setUser($userAdmin);
        $userAdminPreference->setCurrency($currencies[array_rand($currencies)]);

        $manager->persist($userAdmin);
        $manager->persist($userAdminPreference);

    /* Load the John Doe user */
        $userJohnDoe = new User();
        $userJohnDoe->setEmail("john@doe.com");
        $userJohnDoe->setPassword($this->hasher->hashPassword($userJohnDoe,"azerty"));

        $userJohnDoePreference = new UserPreference();
        $userJohnDoePreference->setUser($userJohnDoe);
        $userJohnDoePreference->setCurrency($currencies[array_rand($currencies)]);

        $manager->persist($userJohnDoe);
        $manager->persist($userJohnDoePreference);

    /* Load all classic users */
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($this->hasher->hashPassword($user, "password"));

            $userPreference = new UserPreference();
            $userPreference->setUser($user);
            $userPreference->setCurrency($currencies[array_rand($currencies)]);
            for($j = $i; $j <= 10; $j++) {
                $userPreference->addKeyword($this->getReference(KeywordFixtures::KEYWORD_REFERENCE.($j)));
            }

            for($k = 1; $k <= 9; $k++) {
                $userPreference->addCryptoCurrency($this->getReference(CryptoCurrencyFixtures::CRYPTOCURRENCY_REFERENCE.($k)));
            }

            $manager->persist($user);
            $this->addReference(self::USER_REFERENCE.$i, $user);
            $manager->persist($userPreference);
        }

        $this->addReference(self::ADMIN_USER_REFERENCE, $userAdmin);
        $this->addReference(self::USER_REFERENCE, $userJohnDoe);
        $manager->flush();
    }
}