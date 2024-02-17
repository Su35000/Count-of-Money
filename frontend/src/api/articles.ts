import axios from "axios";
import { UtilsApi } from "./utils";
const baseUrl = import.meta.env.VITE_API_URL;

export class ArticlesApi {
  static async getArticles() {
    const response = await axios.get(baseUrl + "/articles");
    return response.data;
  }

  static async getArticle(id: string) {
    return await axios.get(`${baseUrl}/articles/${id}`, UtilsApi.getHeader());
  }

  static async createArticle(article: any) {
    const response = await axios.post(
      `${baseUrl}/article`,
      {
        title: article.title,
        urlArticle: article.link,
        urlImage: article.enclosure.link,
        summary: article.content,
        source: "article",
        date: article.pubDate,
      },
      UtilsApi.getHeader(),
    );
    return response.data;
  }

  static async updateArticle(id: string, article: any) {
    return await axios.put(
      `${baseUrl}/article/${id}`,
      article,
      UtilsApi.getHeader(),
    );
  }

  static async deleteArticle(id: string) {
    return await axios.delete(`${baseUrl}/article/${id}`, UtilsApi.getHeader());
  }
}
