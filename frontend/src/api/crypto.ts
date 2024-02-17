import axios from "axios";
import { UtilsApi } from "./utils";
const baseUrl = import.meta.env.VITE_API_URL;

export class cryptoApi {
  static async getAllCrypto() {
    return await axios.get(
      baseUrl + "/crypto-currencies",
      UtilsApi.getHeader(),
    );
  }

  static async deleteCrypto(id: any) {
    return await axios.delete(
      baseUrl + "/crypto-currency/" + id,
      UtilsApi.getHeader(),
    );
  }

  static async addCrypto(data: any) {
    return await axios.post(
      baseUrl + "/crypto-currency",
      data,
      UtilsApi.getHeader(),
    );
  }
}
