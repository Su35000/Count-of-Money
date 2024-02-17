import axios from "axios";
const baseUrl = import.meta.env.VITE_API_URL;

export class fluxRssApi {
  static async getAllFluxRss() {
    return await axios.get(baseUrl + "/fluxrss");
  }

  static async getFluxRss(id: string) {
    return await axios.get(`${baseUrl}/fluxrss/${id}`);
  }

  static async createFluxRss(fluxRss: any) {
    return await axios.post(`${baseUrl}/fluxrss`, fluxRss);
  }

  static async updateFluxRss(id: string, fluxRss: any) {
    return await axios.put(`${baseUrl}/fluxrss/${id}`, fluxRss);
  }

  static async deleteFluxRss(id: string) {
    return await axios.delete(`${baseUrl}/fluxrss/${id}`);
  }
}
