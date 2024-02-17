// Utilities
import { defineStore } from "pinia";
import { userApi } from "@/api/user";

export const useUserStore = defineStore("user", {
  state: () => ({
    email: "" as string,
    roles: [] as string[],
    articles: [] as any[],
    crypto: [] as any[],
    isLogged: false as boolean,
  }),

  getters: {
    isAdmin: (state) => state.roles.includes("admin"),
  },

  actions: {
    async register(user: any) {
      return await userApi.register(user);
    },

    async login(user: any) {
      return await userApi.login(user);
    },

    async logout() {
      this.email = "";
      this.roles = [];
      this.articles = [];
      this.crypto = [];
      this.isLogged = false;
      sessionStorage.removeItem("token");
      return await userApi.logout();
    },

    async getCurrentUser() {
      const request = await userApi.getCurrentUser();

      if (request.status === 200) {
        this.email = request.data.email;
        this.roles = request.data.roles;
        this.articles = request.data.articles.map((article: any) => {
          return this.formatArticle(article);
        });
        this.crypto = request.data.cryptoCurrencies;
        this.isLogged = true;
        return true;
      } else {
        return false;
      }
    },

    formatArticle(article: any) {
      return {
        id: article.id,
        title: article.title,
        link: article.urlPage,
        enclosure: {
          link: article.urlImage,
        },
        content: article.summary,
        description: article.summary,
        pubDate: article.date,
      };
    },
  },
});
