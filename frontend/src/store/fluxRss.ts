// Utilities
import { defineStore } from "pinia";
import { fluxRssApi } from "../../src/api/fluxRss";

export const useFluxRssStore = defineStore("fluxRss", {
  state: () => ({
    flux: [] as any[],
  }),

  actions: {
    async fetchFluxRss() {
      const response = await fluxRssApi.getAllFluxRss();
      this.flux = response.data;
      return response.data;

      // const articles = await response.json();
      // this.articles = articles;
      // this.articles = [
      //   {
      //     id: 1,
      //     url: "https://emm.newsbrief.eu/rss/rss?language=fr&type=search&mode=advanced&atLeast=bitcoin",
      //     site: "EMM",
      //     topique: "Bing Actu",
      //     categorie: "Bitcoin",
      //     langue: "fr",
      //   },
      //   {
      //     id: 2,
      //     url: "https://feeds.feedburner.com/Bitcoin-Bingactualits",
      //     site: "Flipboard",
      //     topique: "Bitcoin",
      //     categorie: "Bingactualits",
      //     langue: "fr",
      //   },
      //   {
      //     id: 3,
      //     url: "https://flipboard.com/topic/fr-bitcoin.rss",
      //     site: "Flipboard",
      //     topique: "Bitcoin",
      //     categorie: "Crypto",
      //     langue: "fr",
      //   },
      //   // {
      //   //   id: 4,
      //   //   url: "https://news.google.com/rss/search?tbm=nws&q=when:24h+bitcoin&oq=bitcoin&scoring=n&hl=fr&gl=FR&ceid=FR:fr",
      //   //   site: "Google actu",
      //   //   topique: "Bitcoin",
      //   //   categorie: "Crypto",
      //   //   langue: "fr",
      //   // },
      //   // {
      //   //   id: 5,
      //   //   url: "https://news.google.com/rss/search?tbm=nws&q=blockchain&oq=blockchain&scoring=n&hl=fr&gl=FR&ceid=FR:fr",
      //   //   site: "Google actu",
      //   //   topique: "Blockchain",
      //   //   categorie: "Crypto",
      //   //   langue: "fr",
      //   // },
      //   {
      //     id: 6,
      //     url: "https://flux.saynete.com/encart_rss_informatique_emonnaie_fr.xml",
      //     site: "Saynete",
      //     topique: "Crypto",
      //     categorie: "informatique Emonnaie",
      //     langue: "fr",
      //   },
      //   {
      //     id: 7,
      //     url: "https://www.bfmtv.com/rss/crypto/",
      //     site: "BFM TV",
      //     topique: "crypto",
      //     categorie: "crypto",
      //     langue: "fr",
      //   },
      //   {
      //     id: 8,
      //     url: "https://coinjournal.net/fr/actualites/feed/",
      //     site: "Coinjournal",
      //     topique: "actualites",
      //     categorie: "",
      //     langue: "fr",
      //   },
      //   {
      //     id: 9,
      //     url: "https://coinjournal.net/fr/actualites/category/analyse/feed/",
      //     site: "Coinjournal",
      //     topique: "actualites",
      //     categorie: "analyse",
      //     langue: "fr",
      //   },
      //   {
      //     id: 10,
      //     url: "https://coinjournal.net/fr/actualites/category/affaires/feed/",
      //     site: "Coinjournal",
      //     topique: "actualites",
      //     categorie: "affaires",
      //     langue: "fr",
      //   },
      //   // {
      //   //   id: 11,
      //   //   url: "https://coinjournal.net/fr/actualites/crime/feed/",
      //   //   site: "Coinjournal",
      //   //   topique: "actualites",
      //   //   categorie: "crime",
      //   //   langue: "fr",
      //   // },
      //   {
      //     id: 12,
      //     url: "https://coinjournal.net/fr/actualites/category/evenements/feed/",
      //     site: "Coinjournal",
      //     topique: "actualites",
      //     categorie: "evenements",
      //     langue: "fr",
      //   },
      //   {
      //     id: 13,
      //     url: "https://coinjournal.net/fr/actualites/category/en-vedette/feed/",
      //     site: "Coinjournal",
      //     topique: "actualites",
      //     categorie: "en-vedette",
      //     langue: "fr",
      //   },
      //   {
      //     id: 14,
      //     url: "https://coinjournal.net/fr/actualites/category/interview/feed/",
      //     site: "Coinjournal",
      //     topique: "actualites",
      //     categorie: "interview",
      //     langue: "fr",
      //   },
      // ];
    },
  },
});
