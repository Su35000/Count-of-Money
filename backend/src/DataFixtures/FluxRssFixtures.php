<?php

namespace App\DataFixtures;

use App\Entity\FluxRss;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class FluxRssFixtures extends Fixture
{
    public const FLUXRSS_REFERENCE = 'fluxRss';

    public const LANG_FR = 'fr';

    public const URL_LIST = [
        "",
        "https://www.lemonde.fr",
        "https://emm.newsbrief.eu/rss/rss?language=fr&type=search&mode=advanced&atLeast=bitcoin",
        "https://feeds.feedburner.com/Bitcoin-Bingactualits",
        "https://flipboard.com/topic/fr-bitcoin.rss",
        "https://flux.saynete.com/encart_rss_informatique_emonnaie_fr.xml",
        "https://www.bfmtv.com/rss/crypto/",
        "https://coinjournal.net/fr/actualites/feed/",
        "https://coinjournal.net/fr/actualites/category/analyse/feed/",
        "https://coinjournal.net/fr/actualites/category/affaires/feed/",
        "https://coinjournal.net/fr/actualites/category/evenements/feed/",
        "https://coinjournal.net/fr/actualites/category/en-vedette/feed/",
        "https://coinjournal.net/fr/actualites/category/interview/feed/",
    ];

    public const SITE_LIST = [
        "",
        "Le Monde",
        "EMM",
        "Flipboard",
        "Flipboard",
        "Saynete",
        "BFM TV",
        "Coinjournal",
        "Coinjournal",
        "Coinjournal",
        "Coinjournal",
        "Coinjournal",
        "Coinjournal",
    ];

    public const TOPIC_LIST = [
        "",
        "Actualités",
        "Bing Actu",
        "Bitcoin",
        "Bitcoin",
        "Crypto",
        "crypto",
        "actualites",
        "actualites",
        "actualites",
        "actualites",
        "actualites",
        "actualites"
    ];

    public const CATEGORY_LIST = [
        "",
        "France",
        "Bitcoin",
        "Bingactualits",
        "Crypto",
        "informatique Emonnaie",
        "crypto",
        "",
        "analyse",
        "affaires",
        "evenements",
        "en-vedette",
        "interview",
    ];

    public function load(ObjectManager $manager): void
    {

        /* Load all fluxRss */
        for ($i = 1; $i < 12; $i++) {
            $fluxRss = new FluxRss();
            $fluxRss->setUrl(self::URL_LIST[$i]);
            $fluxRss->setSite(self::SITE_LIST[$i]);
            $fluxRss->setTopique(self::TOPIC_LIST[$i]);
            $fluxRss->setCategorie(self::CATEGORY_LIST[$i]);
            $fluxRss->setLangue(self::LANG_FR);

            $manager->persist($fluxRss);
            $this->addReference(self::FLUXRSS_REFERENCE.$i, $fluxRss);
        }

        $manager->flush();
    }
}