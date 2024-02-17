import axios from "axios";
import { UtilsApi } from "./utils";
const baseUrl = import.meta.env.VITE_API_URL;

export class userApi {
  static async register(user: any) {
    return await axios.post(`${baseUrl}/register`, user);
  }

  static async login(user: any) {
    const response = await axios.post(`${baseUrl}/login`, user);
    return response;
  }

  static async logout() {
    return await axios.post(`${baseUrl}/logout`, {
      headers: UtilsApi.getHeader(),
    });
  }

  static async getCurrentUser() {
    const request = await axios.get(
      `${baseUrl}/users/me`,
      UtilsApi.getHeader(),
    );
    return request;
  }
}
